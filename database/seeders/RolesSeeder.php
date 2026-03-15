<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'admin' => 'Administrador',
        ];

        foreach ($roles as $slug => $name) {

            Role::create([
                'slug' => $slug,
                'name' => $name
            ]);
        }
    }
}