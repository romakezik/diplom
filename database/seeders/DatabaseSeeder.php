<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Route;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //     $this->call([ 
        //     RouteSeeder::class,
        // ]);
        User::create([
            'email' => 'roma2003kezik7@mail.ru',
            'created_at' => '2024-05-10 15:57:50',
            'phone_number' => '+375445963188',
            'password' => '$2y$12$zRsLU.kVoAzcfQY9w4aIWeqTsHqXiV6NTDK8anhxc1zdWC9DPh3CO',
            'remember_token' => 'token1',
            'updated_at' => '2024-05-10 18:56:05',
            'email_verified_at' => '2024-05-10 18:56:05',
            'user_type'=> 1,
        ]);
        User::create([
            'email' => 'admin@mail.ru',
            'created_at' => '2024-05-10 15:57:51',
            'phone_number' => '+375295963188',
            'password' => '$2y$12$zRsLU.kVoAzcfQY9w4aIWeqTsHqXiV6NTDK8anhxc1zdWC9DPh3CO',
            'remember_token' => 'token1',
            'updated_at' => '2024-05-10 18:56:04',
            'email_verified_at' => '2024-05-10 18:56:04',
            'user_type'=> 2,
        ]);
    }
}
