<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DemoContactCompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_companies')->insert([
            [
                'defaulter' => false,
                'company_name' => 'Oceanic Electronics',
                'company_vat' => 'VAT12345678',
                'company_address' => '1234 Sea View Ave, Marina Bay',
                'company_mobile' => '+123456789',
                'company_phone' => '+987654321',
                'company_email' => 'info@oceanicelectronics.com',
                'company_website' => 'http://www.oceanicelectronics.com',
                'company_social_link' => 'http://linkedin.com/company/oceanic-electronics',
                'link' => 'http://www.oceanicelectronics.com/about',
                'link_description' => 'About Oceanic Electronics',
                'last_use' => Carbon::now(),
            ],
            [
                'defaulter' => true,
                'company_name' => 'Maritime Tech Solutions',
                'company_vat' => 'VAT87654321',
                'company_address' => '789 Ocean Drive, Coastal City',
                'company_mobile' => '+987654321',
                'company_phone' => '+123456789',
                'company_email' => 'contact@maritimetechsolutions.com',
                'company_website' => 'http://www.maritimetechsolutions.com',
                'company_social_link' => 'http://linkedin.com/company/maritime-tech-solutions',
                'link' => 'http://www.maritimetechsolutions.com/services',
                'link_description' => 'Services by Maritime Tech Solutions',
                'last_use' => Carbon::now(),
            ]
        ]);
    }
}
