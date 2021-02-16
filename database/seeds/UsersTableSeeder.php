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
            'name' => 'agustin',
            'email' => 'agustin@hotmail.com',
            //Las contaseñas en Laravel deben estar encriptadas siempre. Usamos un helper para eso
            'password' => bcrypt('123456789'),
            'rol_id' => '1'
        ]);
    }
}
