<?php

namespace App\Livewire;

use App\Events\MessageSendEvent;
use App\Models\Client;
use App\Models\Message;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatComponentRestaurant extends Component
{
    public $client;
    public $sender_id;
    public $receiver_id;
    public $message = '';
    public $messages = [];

    public function render()
    {
        return view('livewire.chat-component-restaurant');
    }

    public function mount($client_id){
        $this->sender_id = Auth::guard('restaurant')->user()->id;
        $this->receiver_id = $client_id;

        $messages = Message::where(function ($query) {
            $query->where('sender_id', $this->sender_id)
                ->where('receiver_id', $this->receiver_id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver_id)
                ->where('receiver_id', $this->sender_id);
        })->with('sender_restaurant:id,name', 'receiver_client:id,name')->get();

        foreach($messages as $message) {
            $this->chatMessage($message);
        }

        $this->client = Client::find($client_id);


    }
    public function sendMessage() {
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
        $chatMessage = Message::whereId($event['message']['id'])->with('sender_restaurant:id,name', 'receiver_client:id,name')->first();
        $this->chatMessage($chatMessage);
    }

    public function chatMessage($message) {
        $this->messages[] = [
            'id' => $message->id,
            'message' => $message->message,
            'sender_restaurant' => $message->sender_restaurant,
            'receiver_client' => $message->receiver_client,
        ];
    }

}
