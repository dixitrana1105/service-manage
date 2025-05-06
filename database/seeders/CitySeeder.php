<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['code' => 'AHM', 'name' => 'Ahmedabad'],
            ['code' => 'SUR', 'name' => 'Surat'],
            ['code' => 'VAD', 'name' => 'Vadodara'],
            ['code' => 'RAJ', 'name' => 'Rajkot'],
            ['code' => 'BHJ', 'name' => 'Bhuj'],
            ['code' => 'GND', 'name' => 'Gandhinagar'],
            ['code' => 'JUN', 'name' => 'Junagadh'],
            ['code' => 'BHV', 'name' => 'Bhavnagar'],
            ['code' => 'PAT', 'name' => 'Patan'],
            ['code' => 'AMR', 'name' => 'Amreli'],
            ['code' => 'NVS', 'name' => 'Navsari'],
            ['code' => 'VLS', 'name' => 'Valsad'],
            ['code' => 'GOD', 'name' => 'Godhra'],
            ['code' => 'ANL', 'name' => 'Anand'],
            ['code' => 'DAH', 'name' => 'Dahod'],
            ['code' => 'MOR', 'name' => 'Morbi'],
            ['code' => 'BOT', 'name' => 'Botad'],
            ['code' => 'JAM', 'name' => 'Jamnagar'],
            ['code' => 'BKS', 'name' => 'Bharuch'],
            ['code' => 'DWD', 'name' => 'Dwarka'],
            ['code' => 'VAD', 'name' => 'Vadnagar'],
            ['code' => 'PBR', 'name' => 'Porbandar'],
            ['code' => 'MND', 'name' => 'Mandvi'],
            ['code' => 'SRT', 'name' => 'Surendranagar'],
            ['code' => 'MEH', 'name' => 'Mehsana'],
            ['code' => 'GIR', 'name' => 'Gir Somnath'],
        ];

        // Insert Gujarat cities (Assuming 'state_code' column links cities to the 'Gujarat' state)
        DB::table('city')->insertOrIgnore(array_map(fn($city) => array_merge($city, ['code' => 'GJ']), $cities));

    }
}
