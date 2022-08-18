<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class DailyQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively send an exclusive quote to everyone daily via email.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $quotes= [
            'Nelson Mandela' => 'The greatest glory in living lies not in never falling, but in rising every time we fall.',
            'Walt Disney' => 'The way to get started is to quit talking and begin doing.',
            'Steve Jobs' => "Your time is limited, so don't waste it living someone else's life. Don't be trapped by dogma – which is living with the results of other people's thinking.",
            'Eleanor Roosevelt' => 'If life were predictable it would cease to be life, and be without flavor.',
            'Oprah Winfrey' => "If you look at what you have in life, you'll always have more. If you look at what you don't have in life, you'll never have enough.",
            'James Cameron' => "If you set your goals ridiculously high and it's a failure, you will fail above everyone else's success.",
            'John Lennon' => "Life is what happens when you're busy making other plans.",
        ];
        $key = array_rand($quotes);
        $data = $quotes[$key];

        $users = User::all();
        foreach ($users as $user) {
            Mail::raw("{$key} -> {$data}", function ($mail) use ($user) {
                $mail->from('unnati@topsinosolutions.com');
                $mail->to($user->email)
                    ->subject('Daily New Quote!');
            });
        }

        $this->info('Successfully sent daily quote to everyone.');
        return 0;
    }
}
