<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TwoFactorAuthCodeMail extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * The one-time password.
   *
   * @var string
   */
  public string $code;

  /**
   * Create a new message instance.
   */
  public function __construct(string $code)
  {
    $this->code = $code;
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      subject: 'Your Two-Factor Authentication Code',
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(
      view: 'emails.2fa-code',
    );
  }
}
