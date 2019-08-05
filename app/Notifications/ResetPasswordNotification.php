<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Notifications\TextPasswordReset;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends TextPasswordReset
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $token;

    public function __construct($token)
    {


        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject('パスワードの再発行')
            ->line('パスワード再発行のリクエストを受け付けました')
            ->action('パスワードを再発行する', route('password.reset', $this->token))
            ->line('もしこのメールに心当たりがない場合は、返信する必要はありません。');
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
            //
        ];
    }
}
