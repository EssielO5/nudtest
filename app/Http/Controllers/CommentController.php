<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientCreateCommentRequest;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function order_comment($order_id) {
        $comment = Comment::where('order_id', '=', $order_id)->where('client_id', '=', Auth::guard('client')->user()->id)->first();
        $order = Order::find($order_id);

        if($order && $order->client_id == Auth::guard('client')->user()->id){
            return view('client.restaurant.order-comment', compact('comment', 'order'));
        }else {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }

    }

    public function store(ClientCreateCommentRequest $request){

        $comment = Comment::create([
            'order_id' => $request->order_id,
            'client_id' => $request->client_id,
            'restaurant_id' => $request->restaurant_id,
            'comment' => $request->comment,
        ]);
        if($comment){
            return redirect()->back()->with('success', 'Commentaire effectué avec succès.');
        }else {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }
    }

    public function edit($comment_id) {
        $comment = Comment::find($comment_id);

        if($comment && $comment->client->id == Auth::guard('client')->user()->id){
            return view('client.restaurant.edit-comment', compact('comment'));
        }else {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }

    }

    public function update(Request $request){

        $comment = Comment::find($request->comment_id);


        if($comment){
            $comment->comment = $request->comment;
            $comment->update();
            return redirect()->route('client.commandes.comment', $comment->order->id)->with('success', 'Commentaire effectué avec succès.');
        }else {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }
    }

    public function show_comment_to_restaurant($order_id){
        $comment = Comment::where('order_id', $order_id)->first();
        $order = Order::find($order_id);

        if($order && $order->restaurant_id == Auth::guard('restaurant')->user()->id) {
            return view('restaurant.client-order-comment', compact('comment'));
        }else {
            return redirect()->back()->with('error', 'Une erreur s\'est produite');
        }
    }
}