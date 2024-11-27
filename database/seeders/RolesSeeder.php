<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'super-admin']);
        $administrativo = Role::create(['name' => 'ADMINISTRATIVO']);
        $supervisor = Role::create(['name' => 'SUPERVISOR']);
        $vendedor = Role::create(['name' => 'VENDEDOR']);
        $admin->givePermissionTo(Permission::all());

        $user = User::find(1);
        $user->assignRole([$admin]);

        $user = User::find(2);
        $user->assignRole([$admin]);
    }
}
