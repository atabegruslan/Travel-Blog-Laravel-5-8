<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Notifications\NewEntry;
use Notification;

class minutely extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minutely:demonotice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Minutely demo notice';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $notice = array(
            'url'  => url('/entry/1'),
            'name' => 'Baku',
        );

        Notification::send(User::all(), new NewEntry($notice));

        echo 'Demo Notice Pushed!';
    }
}
