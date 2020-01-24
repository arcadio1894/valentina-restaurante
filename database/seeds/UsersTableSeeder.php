<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jorge Gonzales',
            'email' => 'joryes1894@gmail.com',
            'password' => bcrypt('123456'),
            'role_id' => 1
        ]);
        User::create([
            'name' => 'Juan Perez',
            'email' => 'juanperez@gmail.com',
            'password' => bcrypt('789456'),
            'role_id' => 2
        ]);
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@demo.com',
            'password' => bcrypt('123456'),
            'role_id' => 1
        ]);
    }
}
