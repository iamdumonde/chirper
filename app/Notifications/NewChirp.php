<?php

namespace App\Notifications;

use App\Models\Chirp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class NewChirp extends Notification
{
    use Queueable; // ceci est un trait permettant de mettre une notification en fil d'attente

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Chirp $chirp
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        //via : spécifie par quel canal la notification est envoyé
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("Commentaire créé !")//ce qui apparait quand la notification est envoyée
                    ->line("{$this->chirp->user->name} viens de créer un commentaire")
                    ->line(Str::limit($this->chirp->message, 50))
                    ->action("Voir le commentaire", route("chirps.index"));
                    // ->line('The introduction to the notification.')
                    // ->action('Notification Action', url('/'))
                    // ->line('Thank you for using our application!');
                    // Call to action

                    /**
                     * A défaut de suivre la méthode subject, line , action ci-dessous
                     * l'on peut décider de le faire avec un view, l'on crée son propre format
                     * d'email
                     */
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
