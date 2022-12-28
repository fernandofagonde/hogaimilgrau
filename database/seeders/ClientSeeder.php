<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');

        $count = 0;

        do {

            $password = $faker->randomNumber(6, true);

            DB::table('clients')->insert([
                "status" => $faker->randomElement(['ACTIVE', 'BLOCKED', 'ACTIVE']),
                "name" => $faker->name(),
                "document_type" => 'CPF',
                "document" => $faker->cpf(),
                "phone" => $faker->cellphoneNumber(),
                "phone_whatsapp" => $faker->randomElement(['Y', 'N']),
                "city" => $faker->city(),
                "uf" => $faker->randomElement(["AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RS", "RO",  "RR", "SC", "SE", "SP", "TO"]),
                "image" => "",
                "email" => $faker->email(),
                "password" => Hash::make($password),
                "remember_token" => $password,
            ]);

            $count++;

        }
        while($count < 10);
    }
}
