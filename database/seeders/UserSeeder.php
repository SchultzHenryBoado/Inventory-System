<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'last_name' => 'Boado',
            'first_name' => 'Schultz Henry',
            'email' => 'schultzhenry.boado@obanana.com',
            'password' => bcrypt('abc123'),
            'account_status' => 'ACTIVE'
        ];

        User::create($user);
    }
}
