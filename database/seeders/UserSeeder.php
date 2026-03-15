<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('slug', 'admin')->first();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '123456',
            'role_id' => $adminRole->id,
            'company_id' => null
        ]);

    }

}
