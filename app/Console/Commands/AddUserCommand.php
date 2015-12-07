<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class AddUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:add 
        {email : Email address of the user}
        {password :  Password string for the user}
        {name? : Optionally include a name of the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add User to view site';

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
        $password = $this->argument('password');
        $name = $this->argument('name');

        User::create([
            'email' => $email,
            'password' => $password,
            'name' => isset($name)?$name:'',
        ]);
        
        $this->line('New user was create: '.$email);
    }
}
