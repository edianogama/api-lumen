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
            'username' => 'flamma',
            'password' =>  app('hash')->make($plainPassword),
        ]);
    }
}
