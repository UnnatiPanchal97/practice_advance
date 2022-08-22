<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\EmailNotification;
use Notification;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userEmail=user_email();
        return view('home',compact('userEmail'));
    }
    public function sendNotification()
    {
        $user = User::all();

        $data = [
            'greeting' => 'Hi',
            'body' => 'This is email notification',
            'thanks' => 'Thank you!',
            'actionText' => 'View Site',
            'actionURL' => url('/'),
            'order_id' => 101
        ];

        Notification::send($user, new EmailNotification($data));
    }
}
