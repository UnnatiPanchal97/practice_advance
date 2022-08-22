<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Mail\PostNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

// use Mail;

class NotifyPostCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $users = User::all();
        // dd($users);
        foreach($users as $user) {
            // $name[]=$user->name;
            // $emails[]= $user->email;
            Mail::to($user->email)->send(new PostNotification($user->name));
        }
        // dd($emails);


            // \Illuminate\Support\Facades\Mail::send('emails.post_created', $emails, function (\Illuminate\Mail\Message $message) {
            //     $message->to('unnati@topsinfosolutions.com');
            // });

        // foreach($users as $user) {
        //    Mail::send('emails.post_created', $event->post, function($message){
        //     $message->from(env('MAIL_FROM_ADDRESS'));
        //     $message->to($user);
        //     $message->subject("post notification");
        //    });
        // }
        // Mail::send('Html.view', $data, function ($message) {
        //     $message->from('john@johndoe.com', 'John Doe');
        //     $message->sender('john@johndoe.com', 'John Doe');
        //     $message->to('john@johndoe.com', 'John Doe');
        //     $message->cc('john@johndoe.com', 'John Doe');
        //     $message->bcc('john@johndoe.com', 'John Doe');
        //     $message->replyto('john@johndoe.com', 'John Doe');
        //     $message->subject('Subject');
        //     $message->priority(3);
        //     $message->attach('pathToFile');
        //     });
    }
}
