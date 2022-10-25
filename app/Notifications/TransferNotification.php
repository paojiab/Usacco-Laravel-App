<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransferNotification extends Notification
{
    use Queueable;

    protected $txn_data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($txn_data)
    {
        $this->txn_data = $txn_data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'notify' => 'Dear client, transfer transaction of UGX ' . $this->txn_data['amount'] . ', has been processed: ' . $this->txn_data['status'] . 
            ', ref. ' . $this->txn_data['reference'] . ' For any queries contact us on +256760109642'
        ];
    }
}
