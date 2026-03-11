<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantCreateFormRequest;
use App\Mail\RestaurantActiveMail;
use App\Mail\RestaurantCreateMail as MailRestaurantCreateMail;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Client;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Plat;
use App\Notifications\RestaurantCreateNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Notifications\RestaurantCreateMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class RestaurantController extends Controller
{
    //
    public function login()
    {
        return view('restaurant.login');
    }
    public function profile()
    {
        $restaurants = Restaurant::all();
        return view("restaurant.profile", compact("restaurants"));
    }
    public function restaurants()
    {
        $restaurants = Restaurant::latest()->get();
        return view("admin.restaurants", compact("restaurants"));
    }




    public function dashboard()
    {
        $restaurant = Auth::guard('restaurant')->user();
        $restaurantId = $restaurant->id;

        $ordersCount = Order::where('restaurant_id', $restaurantId)->count();
        $categoriesCount = Category::where('restaurant_id', $restaurantId)->count();
        $platsCount = Plat::where('restaurant_id', $restaurantId)->count();

        $orders = Order::where('created_at', '>=', now()->subDays(7))
            ->whereHas('Restaurant', function ($query) use ($restaurantId) {
                $query->where('id', $restaurantId);
            })
            ->get();


        $labels = [];
        $data = [];
        $locale = 'fr'; // Set the locale to French

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->locale($locale);
            $formattedDate = $date->isoFormat('ddd'); // Format the day name according to the locale
            $count = Order::whereDate('created_at', $date->format('Y-m-d'))
                ->whereHas('Restaurant', function ($query) use ($restaurantId) {
                    $query->where('id', $restaurantId);
                })
                ->count();
            $labels[] = $formattedDate;
            $data[] = $count;
        }

        $chartLabels = json_encode($labels);
        $chartData = json_encode($data);

        $restaurants = Restaurant::all();

        $latestOrder = Order::where('restaurant_id', $restaurant->id)->latest()->first();


        if(Auth::guard('restaurant')->user()->unreadnotifications->count() > 0) {
            toastr()->info('Vous avez une nouvelle notification');
        }


        //Client number
        $clientsCount = Order::whereHas('client', function ($query) use ($restaurant) {
            $query->where('restaurant_id', $restaurant->id);
        })->count();

        //dd($clientsCount);

        return view('restaurant.dashboard', compact('restaurant','chartLabels', 'chartData', 'latestOrder', 'ordersCount', 'categoriesCount', 'platsCount', 'clientsCount'));
    }



    public function connect(Request $request)
    {
        //dd($request->all());
        $check = $request->all();
        if (Auth::guard('restaurant')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            $restaurant = Restaurant::find(Auth::guard('restaurant')->user()->id);
            if($restaurant->status){
                toastr()->success('Connexion réussie');
                return redirect()->route('restaurant.dashboard');
            } else {
                toastr()->error('Votre compte a été désactivé');
                return back();
            }

            /* toastr()->success('Connexion réussie');
            return redirect()->route('restaurant.dashboard'); */

        } else {
            toastr()->error('Email ou mot de passe invalide');
            return back();
        }
        //return view('restaurant.index');
    }
    public function logout()
    {
        Auth::guard('restaurant')->logout();
        toastr()->info('Vous êtes déconnectés avec succès');
        return redirect('/');
    }
    public function about()
    {
        return view('restaurant.register');
    }

    public function register()
    {
        return view('restaurant.registers');
    }


    // public function info()
    // {
    //     return view('info');
    // }


    public function create(RestaurantCreateFormRequest $request)
    {
        $fileName = null; // Pour gérer la suppression si erreur
        try {
            // Vérifie si une image a été envoyée
            if (!$request->hasFile('image')) {
                return back()->with('error', 'Image manquante');
            }

            // Vérifie l’unicité de l’email
            if (Restaurant::where('email', $request->email)->exists()) {
                return back()->with('error', 'Cet email est déjà utilisé par un autre restaurant.');
            }

            // Traitement de l'image
            $file = $request->file('image');
            $fileName = $request->name . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/restaurants'), $fileName);

            // Création du restaurant
            $restaurant = Restaurant::create([
                'name' => $request->name,
                'location' => $request->location,
                'phone' => $request->phone,
                'description' => $request->description,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'image' => $fileName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Notification à l'admin
            $admin = Admin::first();
            if ($admin) {
                $data = [
                    'name' => $admin->name,
                    'email' => $admin->email,
                    'subject' => "Nouvelle demande de création de restaurant.",
                ];

                $admin->notify(new RestaurantCreateNotification($restaurant));
                Mail::send(new MailRestaurantCreateMail($data));
            }

            // Connexion automatique
            Auth::guard('restaurant')->login($restaurant);
            toastr()->success('Compte créé avec succès');
            return redirect()->route('restaurant.dashboard');

        } catch (\Exception $e) {
            // Supprimer l’image si elle a été enregistrée
            if ($fileName && file_exists(public_path('images/restaurants/' . $fileName))) {
                unlink(public_path('images/restaurants/' . $fileName));
            }

            return back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }



    public function update(Request $request)
    {

        $file_name = $request->hidden_restaurant_image;

        if ($request->image != '') {
            $file_name = $request->name . '_'. time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/restaurants'), $file_name);
        }

        $restaurant = Restaurant::find($request->id);
        $restaurant->name = $request->name;
        $restaurant->phone = $request->phone;
        $restaurant->location = $request->location;
        $restaurant->description = $request->description;
        $restaurant->email = $request->email;

        if($request->password != '') {
            $restaurant->password = Hash::make($request->password);
        }
        if($request->status != null) {
            $restaurant->status = $request->status;

        }

        $restaurant->image = $file_name;

        $restaurant->update();
        toastr()->info('Données modifiées avec succès');
        return redirect()->back();
    }


    /* public function destroy(Request $request)
    {

        $restaurant = Restaurant::findOrFail($request->id);
        $image_path = public_path().'/images/restaurants/';
        $image = $image_path.$restaurant->image;
        if (file_exists($image)) {
            unlink($image);
        }
        $restaurant->delete();

        toastr()->error('Le restaurant a bien été supprimé !', " ");
        return redirect()->route("Admin.restaurants");
    } */

    public function destroy(Request $request)
    {
        $restaurant = Restaurant::findOrFail($request->id);

        if($restaurant->image != ''){
            $image_path = public_path().'/images/restaurants/';
            $image = $image_path.$restaurant->image;
            if (file_exists($image)) {
                unlink($image);
            }
        }

        $restaurant->delete();

        toastr()->error('Le restaurant a bien été supprimé !', " ");
        return redirect()->route("Admin.restaurants");
    }






    public function menus(){
        $menus = Menu::where('restaurant_id', '=', Auth::guard('restaurant')->user()->id)->get();
        $categories = Menu::where('restaurant_id', '=', Auth::guard('restaurant')->user()->id)->get();
        return view('restaurant.menus.index', compact('menus'));
    }


    public function menu_add(){
        return view('restaurant.menus.add');
    }


    public function menu_store(Request $request)
    {

        $menu = new Menu();

        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->restaurant_id = $request->restaurant_id;

        $menu->save();

        if($menu) {
            toastr()->success('Menu créé avec succès');
            return redirect()->route("restaurant.menus");
        } else{
            toastr()->error('Données non enregistrées');
            return redirect()->back();
        }
    }

    public function menu_update(Request $request)
    {

        $menu = Menu::find($request->id);

        $menu->name = $request->name;
        $menu->description = $request->description;

        $menu->update();

        if($menu) {
            toastr()->info('Menu modifié avec succès');
            return redirect()->route("restaurant.menus");
        } else{
            toastr()->error('Données non enregistrées');
            return redirect()->back();
        }
    }

    public function menu_destroy(Request $request)
    {

        $menu = Menu::findOrFail($request->id);
        $menu->delete();

        toastr()->error('Le menu a bien été supprimé !', " ");
        return redirect()->route("restaurant.menus");
    }



    public function categories(){
        $menus_restaurants = Menu::where('restaurant_id', '=', Auth::guard('restaurant')->user()->id)->with('categories')->get();
        //dd($menus);
        //$categories = Category::whereIn('menu_id', );
        $menus = Menu::where('restaurant_id', '=', Auth::guard('restaurant')->user()->id)->get();
        return view('restaurant.categories.index', compact(['menus_restaurants', 'menus']));
    }


    public function category_add(){
        $menus = Menu::where('restaurant_id', '=', Auth::guard('restaurant')->user()->id)->get();
        return view('restaurant.categories.add', compact('menus'));

    }


    public function category_store(Request $request)
    {

        $category = new Category();

        $category->name = $request->name;
        $category->description = $request->description;
        $category->menu_id = $request->menu_id;
        $category->restaurant_id = $request->restaurant_id;

        $category->save();

        if($category) {
            toastr()->success('Catégorie créée avec succès');
            return redirect()->route("restaurant.categories");
        } else{
            toastr()->error('Données non enregistrées');
            return redirect()->back();
        }
    }

    public function category_update(Request $request)
    {

        $category = Category::find($request->id);

        $category->menu_id = $request->menu_id;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->restaurant_id = $request->restaurant_id;

        $category->update();

        if($category) {
            toastr()->info('Catégorie modifiée avec succès');
            return redirect()->route("restaurant.categories");
        } else{
            toastr()->error('Données non enregistrées');
            return redirect()->back();
        }
    }

    public function category_destroy(Request $request)
    {

        $category = Category::findOrFail($request->id);
        $category->delete();

        toastr()->error('La catégorie est bien supprimée !', " ");
        return redirect()->route("restaurant.categories");
    }

    public function plats(){
        $plats = Plat::where('restaurant_id', '=', Auth::guard('restaurant')->user()->id)->get();
        //$platsss = Plat::whereIn('category_id', [1,2, 3])->get();
        //dd($platsss);
        //$plats_restaurants = Menu::where('restaurant_id', '=', Auth::guard('restaurant')->user()->id)->with(['categories','plats'])->get();
        $categories = Category::where('restaurant_id', '=', Auth::guard('restaurant')->user()->id)->get();
        return view('restaurant.plats.index', compact(['plats', 'categories']));
    }


    public function plat_add(){
        $categories = Category::where('restaurant_id', '=', Auth::guard('restaurant')->user()->id)->get();
        return view('restaurant.plats.add', compact(['categories']));
    }


    public function plat_store(Request $request)
    {

        $plat = new Plat();

        $file_name = '';
        if($request->image != '') {
            $file_name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/plats'), $file_name);
        }


        $plat->name = $request->name;
        $plat->description = $request->description;
        $plat->price = $request->price;
        $plat->category_id = $request->category_id;
        $plat->restaurant_id = $request->restaurant_id;

        $plat->image = $file_name;

        $plat->save();

        if($plat) {
            toastr()->success('Plat créé avec succès');
            return redirect()->route("restaurant.plats");
        } else{
            toastr()->error('Données non enregistrées');
            return redirect()->back();
        }
    }

    public function plat_update(Request $request)
    {

        $file_name = $request->hidden_plat_image;

        if ($request->image != '') {
            $file_name = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/plats'), $file_name);
        }

        $plat = Plat::find($request->id);
        $plat->name = $request->name;
        $plat->description = $request->description;
        $plat->price = $request->price;
        $plat->category_id = $request->category_id;
        $plat->restaurant_id = $request->restaurant_id;

        if($request->status != null) {
            $plat->status = $request->status;

        }

        $plat->image = $file_name;

        $plat->update();

        if($plat) {
            toastr()->info('Plat modifiée avec succès');
            return redirect()->route("restaurant.plats");
        } else{
            toastr()->error('Données non enregistrées');
            return redirect()->back();
        }
    }

    public function plat_destroy(Request $request)
    {

        $plat = Plat::findOrFail($request->id);
        $image_path = public_path().'/images/plats/';
        $image = $image_path.$plat->image;
        if (file_exists($image)) {
            unlink($image);
        }
        $plat->delete();

        toastr()->error('Le plat est bien supprimée !', " ");
        return redirect()->route("restaurant.plats");
    }

    public function chat_dashboard(){
        //$users = Restaurant::where('id', '!=', Auth::guard('restaurant')->user()->id)->get();
        $clients = Client::all();
        return view('restaurant.chat_dashboard', compact('clients'));
    }

    public function chat($id){
        return view('chat-restaurant', compact('id'));
    }

    public function mark_as_read($id) {
        if($id){
            Auth::guard('restaurant')->user()->notifications->where('id', $id)->markAsRead();
        }
        return back();
    }

    public function notifications(){
        return view('restaurant.notifications');
    }

    public function list_commandes(){
        $orders = Order::where('restaurant_id', Auth::guard('restaurant')->user()->id)->latest()->paginate(10);
        return view('restaurant.orders', compact(['orders']));
    }

    public function details_commandes($id){
        $order = Order::find($id);
        $order_plats = '';
        if($order){
            $order_plats = unserialize($order->plats);
        }

        return view('restaurant.orders-details', compact(['order', 'order_plats']));
    }

}
