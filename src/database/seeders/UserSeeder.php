<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plainPassword = 'senha22';
        
        User::create([
            'email' => 'new@grancursos.com',
            'password' =>  app('hash')->make($plainPassword),
        ]);
    }
}
