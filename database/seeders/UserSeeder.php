<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
        ]);

        $agents = ['Ali', 'Ahmad', 'Usama', 'Haseeb'];

        foreach ($agents as $name) {
            User::create([
                'name' => $name,
                'email' => strtolower($name) . '@gmail.com',
                'password' => Hash::make('1234'),
                'role' => 'agent',
            ]);
        }
    }
}
