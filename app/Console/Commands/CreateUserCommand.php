<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

/**
 * Class CreateUserCommand
 *
 * @package App\Console\Commands
 */
class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for create users';

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
     * Execute the console command
     *
     * @return void
     */
    public function handle(): void
    {
        $user = new User();
        $user->name = $this->argument('name');
        $user->email = $this->argument('email');
        $user->password = $this->argument('password');

        $user->save();

        $this->info('Create user success');
    }
}
