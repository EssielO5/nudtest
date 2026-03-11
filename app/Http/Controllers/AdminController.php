<?php

namespace App\Http\Controllers;

use App\Mail\RestaurantActiveMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Client;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //
    public function login()
    {
        return view('admin.login');
    }
    public function dashboard()
    {
        $nbr_resto = Restaurant :: count();
        $nbr_client = Client :: count();
        $restaurants = Restaurant::all();

        /* foreach ($restaurants as $restaurant) {
            $reservationCount = Reservation::whereHas('table', function ($query) use ($restaurant) {
                $query->where('restaurant_id', $restaurant->id);
            })->count();

            $restaurant->reservationCount = $reservationCount;
        } */
        if(Auth::guard('admin')->user()->unreadnotifications->count() > 0) {
            toastr()->info('Vous avez une nouvelle notification');
        }
        return view('admin.dashboard',compact('nbr_resto','nbr_client','restaurants'));
    }
    public function profile()
    {
        return view('admin.profile');
    }

    public function profile_update(Request $request)
    {
        $admin = Admin::find($request->id);
        $admin->name = $request->name;
        $admin->email = $request->email;

        if($request->password != '') {
            $admin->password = Hash::make($request->password);
        }

        $admin->update();

        toastr()->success('Données modifiées avec succès');
        return redirect()->back();
    }

    public function connect(Request $request)
    {
        //dd($request->all());
        $check = $request->all();
        if (Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            toastr()->success('Connexion effectuée avec succès');
            return redirect()->route('admin.dashboard');
        } else {
            return back()->with('error', 'Email ou mot de passe invalide');
        }
        //return view('restaurant.index');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        toastr()->info('Se déconnecter avec succès');
        return redirect('/');
    }
     public function register()
     {
         return view('admin.register');
     }

    public function create(Request $request)
    {
       // dd($request->all());
       Admin::insert([
        'name' => 'admin_name',
        'email' => 'admin_email@example.com',
        'password' => Hash::make('admin_password'),
        'created_at' => now(),
       ]);
       toastr()->success('Données enregistrées avec succès');
        return redirect()->route("admin.dashboard");

    }

    public function restaurant_add()
    {
        return view('admin.restaurant_add');
    }

    public function restaurant_save(Request $request)
    {
        $restaurant = new Restaurant();

        $file_name = $request->name .'_'. time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/restaurants'), $file_name);


        $restaurant->name = $request->name;
        $restaurant->phone = $request->phone;
        $restaurant->location = $request->location;
        $restaurant->description = $request->description;
        $restaurant->email = $request->email;
        $restaurant->password = Hash::make($request->password);
        $restaurant->created_at = Carbon::now();

        // If Admin Status = 1
        $restaurant->status = 1;
        $restaurant->is_verified = 1;

        $restaurant->image = $file_name;

        $restaurant->save();

        if($restaurant) {
            toastr()->success('Données enregistrées avec succès');
            return redirect()->route("Admin.restaurants");
        } else{
            toastr()->error('Données non enregistrées');
            return redirect()->back();
        }


    }

    public function client_add()
    {
        return view('admin.client_add');
    }

    public function client_save(Request $request)
    {
        $client = new Client();

        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->password = Hash::make($request->password);
        $client->created_at = Carbon::now();

        // If Admin Status = 1
        $client->status = 1;

        $client->save();

        if($client) {
            toastr()->success('Données enregistrées avec succès');
            return redirect()->route("Admin.clients");
        } else{
            toastr()->error('Données non enregistrées');
            return redirect()->back();
        }

    }

    public function mark_as_read($id) {
        if($id){
            Auth::guard('admin')->user()->notifications->where('id', $id)->markAsRead();
        }
        return back();
    }

    public function notifications(){
        return view('admin.notifications');
    }
    public function active_restaurant($notification, $id){

        $restaurant = Restaurant::findOrFail($id);

        $restaurant->is_verified = 1;
        $restaurant->update();

        $data['name'] = $restaurant->name;
        $data['phone'] = $restaurant->phone;
        $data['email'] = $restaurant->email;
        $data['location'] = $restaurant->location;

        $data['subject'] = "Votre restaurant a été activé avec succès.
            Il s'affichera dès maintenant dans la liste des restaurants officiels de nôtre application";

        Mail::send(new RestaurantActiveMail($data));
        return redirect()->route('admin.mark_as_read', $notification);

    }

    public function refuse_restaurant($notification, $id){

        $restaurant = Restaurant::findOrFail($id);

        $data['name'] = $restaurant->name;
        $data['phone'] = $restaurant->phone;
        $data['email'] = $restaurant->email;
        $data['location'] = $restaurant->location;
        //dd($data['email']);
        $data['subject'] = "La demande de vôtre restaurant sur la Plateforme Nudùtin n'est pas éligible.
            Veuillez nous contacter pour plus d'informations ou lancer à nouveau vôtre requête...";

        if($restaurant->image != ''){
            $image_path = public_path().'/images/restaurants/';
            $image = $image_path.$restaurant->image;
            if (file_exists($image)) {
                unlink($image);
            }
        }
        $restaurant->delete();

        Mail::send(new RestaurantActiveMail($data));
        return redirect()->route('admin.mark_as_read', $notification);

    }
}