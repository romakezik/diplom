<?php

namespace Database\Seeders;

// database/seeders/CarSeeder.php

use App\Models\User;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\argumentsSet;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'roma2003kezik7@mail.ru',
            'created_at' => '2024-05-10 15:57:50',
            'phone_number' => '+375445963188',
            'password' => '$2y$12$zRsLU.kVoAzcfQY9w4aIWeqTsHqXiV6NTDK8anhxc1zdWC9DPh3CO',
            'remember_token' => 'token1',
            'updated_at' => '2024-05-10 18:56:05',
            'email_verified_at' => '2024-05-10 18:56:05',
        ]);
    }
}
