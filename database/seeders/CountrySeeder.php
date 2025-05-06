<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['code' => 'US', 'name' => 'United States'],
            ['code' => 'CA', 'name' => 'Canada'],
            ['code' => 'AF', 'name' => 'Afghanistan'],
            ['code' => 'AL', 'name' => 'Albania'],
            ['code' => 'DZ', 'name' => 'Algeria'],
            ['code' => 'AS', 'name' => 'American Samoa'],
            ['code' => 'AD', 'name' => 'Andorra'],
            ['code' => 'AO', 'name' => 'Angola'],
            ['code' => 'AI', 'name' => 'Anguilla'],
            ['code' => 'AQ', 'name' => 'Antarctica'],
            ['code' => 'AG', 'name' => 'Antigua and/or Barbuda'],
            ['code' => 'AR', 'name' => 'Argentina'],
            ['code' => 'AM', 'name' => 'Armenia'],
            ['code' => 'AW', 'name' => 'Aruba'],
            ['code' => 'AU', 'name' => 'Australia'],
            ['code' => 'AT', 'name' => 'Austria'],
            ['code' => 'AZ', 'name' => 'Azerbaijan'],
            ['code' => 'BS', 'name' => 'Bahamas'],
            ['code' => 'BH', 'name' => 'Bahrain'],
            ['code' => 'BD', 'name' => 'Bangladesh'],
            ['code' => 'BB', 'name' => 'Barbados'],
            ['code' => 'BY', 'name' => 'Belarus'],
            ['code' => 'BE', 'name' => 'Belgium'],
            ['code' => 'BZ', 'name' => 'Belize'],
            ['code' => 'BJ', 'name' => 'Benin'],
            ['code' => 'BM', 'name' => 'Bermuda'],
            ['code' => 'BT', 'name' => 'Bhutan'],
            ['code' => 'BO', 'name' => 'Bolivia'],
            ['code' => 'BQ', 'name' => 'Bonaire, Sint Eustatius and Saba'],
            ['code' => 'BA', 'name' => 'Bosnia and Herzegovina'],
            ['code' => 'BW', 'name' => 'Botswana'],
            ['code' => 'IN', 'name' => 'India'], // Added India
        ];

        // Truncate the table before inserting (optional)
        DB::table('countries')->truncate();

        // Insert data with duplicate prevention
        DB::table('countries')->insertOrIgnore($countries);
    }
}
