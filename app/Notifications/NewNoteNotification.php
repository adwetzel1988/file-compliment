<?php

namespace App\Notifications;

use App\Models\Message;
use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNoteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected readonly Note $message)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Internal Note Added')
            ->line('A new internal note has been added to your complaint.')
            ->line('Sent by: ' . $this->message->user->name)
            ->line('Note: ' . $this->message->content)
            ->action('View Complaint', route('complaints.show', $this->message->complaint_id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message_id' => $this->message->id,
            'complaint_id' => $this->message->complaint_id,
            'content' => $this->message->content,
            'sender_name' => $this->sender->name,
        ];
    }
}
