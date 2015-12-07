<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class DeleteUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete 
        {email : Email address of the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete User from the site';

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
        $email = $this->argument('email');

        $user = User::where('email','=',$email)->first();
        
        if($user != null) {
            $user->delete();
        }
        
        $this->line('User was deleted: '.$email);
    }
}
