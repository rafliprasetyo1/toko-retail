<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateMitraDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach (range(1, 20) as $index) {
            DB::table('mitra')->insert([
                'nama_mitra' => $faker->company,
                'alamat' => $faker->address,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'jenisMitra' => $faker->randomElement(['Platinum', 'Gold', 'Silver']),
                'tanggal_bergabung' => $faker->date('Y-m-d', '2005-12-31'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
