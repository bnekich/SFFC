<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class SendTwoFactorCode extends Notification
{
  use Queueable;

  /**
   * The one-time password.
   *
   * @var string
   */
  public string $code;

  /**
   * Create a new notification instance.
   */
  public function __construct(string $code)
  {
    $this->code = $code;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  // public function via(object $notifiable): array
  // {
  //   // For development, we log it. In production, you'd add a real SMS channel like 'vonage'.
  //   return ['log'];
  // }

  public function via(object $notifiable): array
  {
    // For development, log the notification details instead of sending SMS.
    if (app()->environment('local')) {
      Log::info('2FA SMS Notification', [
        'user' => $notifiable->id,
        'message' => $this->code, // Assuming you have a toSms method
      ]);
      return []; // Return an empty array to prevent sending notifications
    }

    // In production, use a real SMS channel like 'vonage'.
    return ['vonage'];
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    return [
      'message' => 'Your two-factor authentication code is: ' . $this->code,
    ];
  }
}
