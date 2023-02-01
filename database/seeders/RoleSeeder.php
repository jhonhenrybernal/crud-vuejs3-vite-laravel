<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Administrador',
            ],
            [
                'name' => 'Usuario',
            ],
            [
                'name' => 'Cliente',
            ]
            ];
        foreach ($roles as $key => $value) {
            \App\Models\Role::insert($value);
        }
    }
}
