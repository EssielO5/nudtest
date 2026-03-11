<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PaymentGateway;
use App\Models\Restaurant;
use FedaPay\FedaPay;
use FedaPay\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function initPayment(Request $request) {

        $request->validate([
            'client_id' => ['required'],
            'name' => ['required', 'string'],
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|size:12',
            'adresse' => ['required', 'string'],
            'montant_total' => ['required', 'numeric'],
        ], [
            'phone' => 'Le numéro de téléphone doit contenir 12 caractères'
        ]);

        // Infos du client qui reçoit la commande
        $infos = [
            "name" => $request->name,
            "phone" => $request->phone,
            "adresse" => $request->adresse,
            "client_id" => $request->client_id,
            "restaurant_id" => $request->restaurant_id,
            "montant_total" => $request->montant_total,
        ];
        session()->get('client_infos');

        session()->put('client_infos', $infos);

        $client = Client::find($request->client_id);
        $payment_gateway = PaymentGateway::where('restaurant_id', '=', $request->restaurant_id)->first();

        if ($client && $payment_gateway) {

            // Transaction operation
            FedaPay::setApiKey($payment_gateway->private_key);
            FedaPay::setEnvironment($payment_gateway->mode);

            $transaction = Transaction::create(array(
                "description" => "Transaction de ". $request->name,
                "amount" => $request->montant_total,
                "currency" => ["iso" => "XOF"],
                "callback_url" => "http://localhost:8000/client/commande-success",
                "customer" => [
                    "firstname" => "",
                    "lastname" => $client->name,
                    "email" => $client->email,
                    "phone_number" => [
                        "number" => $request->phone,
                        "country" => "bj"
                    ]
                ]
            ));

            $token = $transaction->generateToken();
            //dd($token->url);

            return redirect()->to($token->url);
        }else {
            return redirect()->back()->with('error', 'Une erreur s\est produite');
        }
    }

    public function set_payment_keys(){

        $payment_gateway = PaymentGateway::where('restaurant_id', Auth::guard('restaurant')->user()->id)->first();
        //dd($payment_gateway->private_key);
        if($payment_gateway){
            return view('restaurant.payment-gateway', compact('payment_gateway'));
        }else{
            return view('restaurant.payment-gateway');
        }
    }

    public function handle_payment_keys(Request $request){

        $request->validate([
            'private_key' => 'required',
            'public_key' => 'required',
        ],[
            'private_key.required' => 'Ce champ est requis',
            'public_key.required' => 'Ce champ est requis',
        ]);

        $payment_gateway = PaymentGateway::where('restaurant_id', Auth::guard('restaurant')->user()->id)->first();

        if($payment_gateway){

            $payment_gateway->public_key = $request->public_key;
            $payment_gateway->private_key = $request->private_key;
            $payment_gateway->update();

            return redirect()->back()->with('info', 'Information modifiée avec succès.');
        }else{

            $payment_gateway = new PaymentGateway();

            $payment_gateway->public_key = $request->public_key;
            $payment_gateway->private_key = $request->private_key;
            $payment_gateway->restaurant_id = Auth::guard('restaurant')->user()->id;
            $payment_gateway->save();

            return redirect()->back()->with('success', 'Enregistrement effectée avec succès.');
        }
    }

    public function payment_environment() {
        $payment = PaymentGateway::first();
        return view('admin.payment-environment', compact('payment'));
    }

    public function handle_payment_environment(Request $request){
        $request->validate([
            'mode' => 'required', 'in:sandbox,live'
        ], [
            'mode.required' => 'Ce champ est requis.'
        ]);

        $paymentGateways = PaymentGateway::all();
        foreach ($paymentGateways as $paymentGateway) {
            $paymentGateway->mode = $request->mode;
            $paymentGateway->update();
        }



        return redirect()->back()->with('success', 'Données enregistrées avec succès.');
    }

}
