<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GeneratePasswordHash extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password:hash {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate bcrypt hash for a given password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $password = $this->argument('password');
        $hash = Hash::make($password);
        $this->info($hash);
    }
}
