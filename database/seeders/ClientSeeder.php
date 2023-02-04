<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Client::create([
            'name' => 'Administrador cliente compra',
            'login' => 'adminCompra@example.com',
            'password' => Hash::make('12345'), // password
            'remember_token' => Str::random(10),
            'login_verified_at' => now(),
            'rol' => 1
        ]);
    }
}
