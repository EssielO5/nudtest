<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RestaurantCreateNotification extends Notification
{
    use Queueable;
    public $restaurant;

    /**
     * Create a new notification instance.
     */
    public function __construct($restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'restaurant_id' => $this->restaurant['id'],
            'name' => $this->restaurant['name'],
            'phone' => $this->restaurant['phone'],
            'location' => $this->restaurant['location'],
            'image' => $this->restaurant['image'],
            'email' => $this->restaurant['email'],
            'message' => 'Un nouveau restaurant est créé',
        ];
    }
}