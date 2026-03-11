<?php

namespace App\Livewire;

use App\Events\MessageSendEvent;
use App\Models\Client;
use App\Models\Message;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatComponentClient extends Component
{
    public $restaurant;
    public $sender_id;
    public $receiver_id;
    public $message = '';
    public $messages = [];
    public function render()
    {
        return view('livewire.chat-component-client');
    }

    public function mount($restaurant_id){
        $this->sender_id = Auth::guard('client')->user()->id;
        $this->receiver_id = $restaurant_id;

        $messages = Message::where(function ($query) {
            $query->where('sender_id', $this->sender_id)
                ->where('receiver_id', $this->receiver_id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver_id)
                ->where('receiver_id', $this->sender_id);
        })->with('sender_client:id,name', 'receiver_restaurant:id,name')->get();

        foreach($messages as $message) {
            $this->chatMessage($message);
        }

        $this->restaurant = Restaurant::find($restaurant_id);
    }
    public function sendMessage() {
        // dd($this->message);
        $message = new Message();
        $message->sender_id = $this->sender_id;
        $message->receiver_id = $this->receiver_id;
        $message->message = $this->message;
        $message->save();
        $this->chatMessage($message);
        broadcast(new MessageSendEvent($message))->toOthers();

        $this->message = '';

    }

    #[On('echo-private:chat-channel.{sender_id},MessageSendEvent')]
    public function listenForMessage($event){
        $chatMessage = Message::whereId($event['message']['id'])->first()->with('sender_client:id,name', 'receiver_restaurant:id,name');
        $this->chatMessage($chatMessage);
    }

    public function chatMessage($message) {
        $this->messages[] = [
            'id' => $message->id,
            'message' => $message->message,
            'sender_client' => $message->sender_client,
            'receiver_restaurant' => $message->receiver_restaurant,
            //'receiver_restaurant' => $message->receiver_restaurant->name,
        ];
        //broadcast(new MessageSendEvent($message))->toOthers();
    }

}