<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Fernando Fagonde',
            'image' => '',
            'email' => 'fernando@ipsillon.cc',
            'password' => Hash::make('123456')
    	]);
	User::create([
            'name' => 'Luciano Brighenti',
            'image' => '',
            'email' => 'luciano@hogai.com.br',
            'password' => Hash::make('123456')
        ]);
	
    }
}
