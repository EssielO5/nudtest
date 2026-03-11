<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientCreateFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Client;
use App\Models\Order;
use App\Models\Plat;
use App\Notifications\ClientCommandeNotification;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;

class ClientController extends Controller
{
    //
    public function login()
    {
        return view('client.login');
    }

    public function clients()
    {
        $clients = Client::latest()->get();
        return view("admin.clients", compact("clients"));
    }

    public function dashboard()
    {
        $restaurants = Restaurant::all();
        return view('client.index', compact("restaurants"));
    }
    public function profile()
    {
        return view('client.profile');
    }

    public function connect(Request $request)
    {
        $check = $request->only(['email', 'password']);

        if (Auth::guard('client')->attempt([
            'email' => $check['email'],
            'password' => $check['password'],
        ])) {
            Toastr::success('Connexion effectuée avec succès');
            return redirect()->route('view_all');
        } else {
            Toastr::error('Email ou mot de passe invalide');
            return back();
        }
    }

    public function register()
    {
        return view('client.register');
    }
    public function create(ClientCreateFormRequest $request)
    {
        // dd($request->all());
        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);
        Auth::guard("client")->login($client);
        toastr()->success('Données enregistrées avec succès');
        return redirect()->route('view_all');
    }
    public function update(Request $request)
    {

        $client = Client::find($request->id);
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->email = $request->email;

        if($request->password != '') {
            $client->password = Hash::make($request->password);
        }
        if($request->status != null) {
            $client->status = $request->status;
        }

        $client->save();

        toastr()->info('Données modifiées avec succès');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $client = Client::findOrFail($request->id);
        $client->delete();
        toastr()->error('Le client a été bien supprimé !', " ");
        return redirect()->route("Admin.clients");
    }
    public function logout()
    {
        Auth::guard('client')->logout();
        toastr()->success('Déconnexion effectuée avec succès');
        return redirect('/');
    }

    public function plats_of_this_restaurant($id){
        $restaurant = Restaurant::find($id);
        if($restaurant) {
            $plats = Plat::where('restaurant_id', '=', $id)->where('status', '=', 1)->get();
            return view('client.restaurant.plats', compact(['restaurant', 'plats']));
        } else {
            return redirect()->back()->with('error', 'Restaurant non trouvé');
        }

    }

    public function addToCart($plat_id){

        $plat = Plat::findOrFail($plat_id);

        $cart = session()->get('cart', []);

        $restaurant = Restaurant::find($plat->restaurant_id);

        if(!empty(session()->get('cart'))) {
            foreach (session()->get('cart') as $elt) {
                if($elt['restaurant_id'] != $plat->restaurant_id) {
                    return back()->with('error', 'Vous ne pouvez pas ajouter des plats de différents restaurants au panier');
                }
            }
        }
        if(isset($cart[$plat_id])) {
            $cart[$plat_id]['quantity']++;
        } else {
            $cart[$plat_id] = [
                "plat_name" => $plat->name,
                "image" => $plat->image,
                "price" => $plat->price,
                "quantity" => 1,
                "restaurant_id" => $restaurant->id,
            ];
        }
        //$string = json_encode($cart);
        //dd(json_decode($string, true));

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Plat ajouté au panier avec succès !');


    }

    public function cart() {
        return view('client.restaurant.cart');
    }

    public function remove_from_cart(Request $request) {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])){
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Plat retiré avec succès !');
        }
    }

    public function update_cart(Request $request){

        if($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Panier mis à jour avec succès !');
        }
    }

    public function commande_success(Request $request){

        $status = $request->get('status');
        $payment_id = $request->get('id');

        //dd($request->get('status'));

        if($status == "approved") {

            $order = new Order();

            $client_infos = session()->get('client_infos');
            $order->name = $client_infos['name'];
            $order->phone = $client_infos['phone'];
            $order->adresse = $client_infos['adresse'];
            $order->restaurant_id = $client_infos['restaurant_id'];
            $order->client_id = $client_infos['client_id'];
            $order->montant_total = $client_infos['montant_total'];
            $order->payment_id = $payment_id;

            $plats = [];
            $i = 0;
            //dd(session()->get('cart'));

            foreach (session()->get('cart') as $plat) {
                $plats['plat_' . $i][] =  $plat['plat_name'];
                $plats['plat_' . $i][] =  $plat['image'];
                $plats['plat_' . $i][] =  $plat['price'];
                $plats['plat_' . $i][] =  $plat['quantity'];
                $i++;
                //dd($plat['plat_name']);
            }
            $order->plats = serialize($plats);

            $order->save();

            session()->forget('cart');
            session()->forget('client_infos');

            $restaurant = Restaurant::find($order->restaurant->id);
            $restaurant->notify(new ClientCommandeNotification($order));

            Session::flash('success-payment', 'Vôtre commande a été traité avec succès.');

            return redirect()->route('client.order.thanks')->with('success', 'Commande passée avec succès... Livraison  en cours...');
        } else {
            toastr()->error('Une erreur s\'est produite');
            return redirect()->route('client.cart')->with('error', 'Vôtre paiement a échoué. Veuillez réessayer !');
        }
    }

    public function thanks(){
        return Session::has('success-payment') ? view('client.thanks') : redirect()->route('home');
    }

    public function lister_commandes() {
        $commandes = Order::where('client_id', '=', Auth::guard('client')->user()->id)->latest()->paginate(5);
        //dd($commandes);
        return view('client.restaurant.commandes', compact('commandes'));
    }

    public function generate_commande_pdf($id) {
        $order = Order::find($id);
        $order_plats = '';
        $now = Carbon::now();
        $imagePath = public_path('img/resto2.png');
        if($order){
            $order_plats = unserialize($order->plats);
        }
        $pdf = PDF::loadView('client.pdf.commande', [
            'order' => $order,
            'order_plats' => $order_plats,
            'now' => $now,
            'imagePath' => $imagePath,
        ]);
        return $pdf->download('commande.pdf');
    }

    public function details_commandes($id) {
        $order = Order::find($id);
        $order_plats = '';
        if($order && $order->client_id == Auth::guard('client')->user()->id){
            $order_plats = unserialize($order->plats);
            return view('client.restaurant.details_commande', compact(['order', 'order_plats']));
        }else {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }


    }
    public function chat_dashboard(){
        //$users = Restaurant::where('id', '!=', Auth::guard('restaurant')->user()->id)->get();
        $restaurants = Restaurant::all();
        return view('client.chat_dashboard', compact('restaurants'));
    }

    public function chat($id){
        return view('chat-client', compact('id'));
    }

    public function show_plat($id){
        $plat = Plat::findOrFail($id);

        $restaurant = Restaurant::find($plat->restaurant_id);
        return view('client.restaurant.plat', compact('plat', 'restaurant'));
    }


}