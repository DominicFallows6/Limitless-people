<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class EncyrptData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'encrypt:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var \Illuminate\Encryption\Encrypter
     */
    private $encrypter;
    /**
     * @var \Powhr\Models\User
     */
    private $users;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(\Illuminate\Encryption\Encrypter $encrypter, \Powhr\Models\User $users)
    {
        parent::__construct();
        $this->encrypter = $encrypter;
        $this->users = $users;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = $this->users->getUserList();
        foreach($users AS $key => $user) {
            echo $user->email;
            echo PHP_EOL;
        }
    }
}
