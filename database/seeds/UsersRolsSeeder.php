<?php

use Illuminate\Database\Seeder;
use App\Rol;

class UsersRolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            'type' => 'root'
        ]);

        Rol::create([
            'type' => 'local_admin'
        ]);

        Rol::create([
            'type' => 'registered_user'
        ]);

        Rol::create([
            'type' => 'guest_user'
        ]);
    }
}
