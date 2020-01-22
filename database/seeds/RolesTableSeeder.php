<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrador',
            'description' => 'Rol Administrador'
        ]);
        Role::create([
            'name' => 'Usuario',
            'description' => 'Rol Usuario'
        ]);
        Role::create([
            'name' => 'Employee',
            'description' => 'Rol Empleado'
        ]);
    }
}
