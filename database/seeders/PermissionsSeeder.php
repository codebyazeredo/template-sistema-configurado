<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'users.view',
            'users.create',
            'users.update',
            'users.delete',

            'company.update',

            'roles.view',
            'roles.update',
        ];

        foreach ($permissions as $permission) {

            Permission::create([
                'name' => $permission
            ]);

        }
    }
}
