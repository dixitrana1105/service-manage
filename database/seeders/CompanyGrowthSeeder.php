<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CompanyGrowthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $growthData = [
            ['year' => 2019, 'revenue' => 2.5],
            ['year' => 2020, 'revenue' => 3.8],
            ['year' => 2021, 'revenue' => 5.2],
            ['year' => 2022, 'revenue' => 7.5],
            ['year' => 2023, 'revenue' => 9.1],
            ['year' => 2024, 'revenue' => 12.4],
            ['year' => 2025, 'revenue' => 15.3],
        ];

        foreach ($growthData as $data) {
            DB::table('company_growths')->insert([
                'year' => $data['year'],
                'revenue' => $data['revenue'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
