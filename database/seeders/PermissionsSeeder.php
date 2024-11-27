<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //PERMISOS
        $crear = Permission::create(['name' => 'PERMISO.CREAR']);
        $editar = Permission::create(['name' => 'PERMISO.EDITAR']);
        $eliminar = Permission::create(['name' => 'PERMISO.ELIMINAR']);
        $mostrar = Permission::create(['name' => 'PERMISO.MOSTRAR']);
        $listar = Permission::create(['name' => 'PERMISO.LISTAR']);


        //ROLES
        $crear = Permission::create(['name' => 'ROLE.CREAR']);
        $editar = Permission::create(['name' => 'ROLE.EDITAR']);
        $eliminar = Permission::create(['name' => 'ROLE.ELIMINAR']);
        $mostrar = Permission::create(['name' => 'ROLE.MOSTRAR']);
        $listar = Permission::create(['name' => 'ROLE.LISTAR']);


    }
}
