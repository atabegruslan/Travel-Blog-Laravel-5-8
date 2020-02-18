<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use App\Channels\FirebaseChannel;

class NewEntry extends Notification
{
    use Queueable;

    protected $entry_url;
    protected $name;
    protected $entry_id;
    protected $img_url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notice)
    {
        $this->entry_url = $notice['entry_url'];
        $this->name      = $notice['name'];
        $this->entry_id  = $notice['entry_id'];
        $this->img_url   = $notice['img_url'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', /*WebPushChannel::class,*/ FirebaseChannel::class];
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
                    ->line('A new Travel Blog entry about ' . $this->name . ' was added')
                    ->action('Visit new entry', $this->entry_url)
                    ->line('Thank you for using our website!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'url'  => $this->entry_url,
            'name' => $this->name,
        ];
    }

    public function toWebPush($notifiable, $notification)
    {
        $data = [
            'entry_id'  => $this->entry_id,
            'entry_url' => $this->entry_url,
            'base_url'  => url('/'),
        ];

        return (new WebPushMessage)
            ->title('New Travel Blog entry!')
            ->icon(url('/images/sys/favicon-1.png'))
            ->body('A new Travel Blog entry about ' . $this->name . ' was added')
            ->data($data)
            ->dir('ltr')
            ->image($this->img_url)
            ->lang('en-US')
            ->tag($notification->id)
            ->action('View entry', 'view')
            ->action('No thanks', 'close')
            ->vibrate([100, 50, 100]);
            // ->renotify()
            // ->requireInteraction()
            // ->badge();
    }

    public function toFirebase($notifiable, $notification)
    {
        $data = [
            'entry_id'  => $this->entry_id,
            'entry_url' => $this->entry_url,
            'base_url'  => url('/'),
        ];

        $message = [    
            'title'   => 'New Travel Blog entry!',    
            'body'    => 'A new Travel Blog entry about ' . $this->name . ' was added',   
            'icon'    => url('/images/sys/favicon-1.png'),
            'data'    => $data,   
            'dir'     => 'ltr',
            'image'   => $this->img_url, 
            'lang'    => 'en-US',  
            'tag'     => $notification->id, 
            'actions' => [
                            ['title' => 'View', 'action' => 'view'],
                            ['title' => 'Close', 'action' => 'close'],
                        ],  
            'vibrate' => [100, 50, 100],
        ];  

        return $message;
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
