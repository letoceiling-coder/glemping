<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:create-AdminUserRoot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создание админ';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $password = 123123123;//Str::random(8);
        User::create([
            'name' => 'ADMIN',
            'surname' => 'ADMIN',
            'email' => "dsc-23@yandex.ru",
            'password' => Hash::make($password),
            'role_id' => 999
        ]);
        $this->info("Success");
        $this->info("login - dsc-23@yandex.ru && password - " . $password);

    }
}
