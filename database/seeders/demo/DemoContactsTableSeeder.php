<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DemoContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_contacts')->insert([
            [
                'contact_first_name' => 'John',
                'contact_last_name' => 'Doe',
                'contact_nif' => '123456789A',
                'contact_address' => '123 Main St, Anytown',
                'contact_country' => 'Countryland',
                'contact_mobile' => '+1234567890',
                'contact_mobile_2' => '+0987654321',
                'contact_email' => 'john.doe@example.com',
                'contact_email_2' => 'j.doe@example.com',
                'social_link' => 'http://linkedin.com/in/johndoe',
                'contact_tags' => 'VIP, Regular',
                'contact_notes' => 'Important client, handle with care.',
                'contact_internalnotes' => 'Met at trade show 2023.',
                'link' => 'http://example.com/contact/john-doe',
                'link_description' => 'Personal Website',
                'last_use' => Carbon::now(),
            ],
            [
                'contact_first_name' => 'Jane',
                'contact_last_name' => 'Smith',
                'contact_nif' => '987654321B',
                'contact_address' => '456 Another Ln, Anytown',
                'contact_country' => 'Countryland',
                'contact_mobile' => '+1234567891',
                'contact_mobile_2' => '+0987654322',
                'contact_email' => 'jane.smith@example.com',
                'contact_email_2' => 'j.smith@example.com',
                'social_link' => 'http://linkedin.com/in/janesmith',
                'contact_tags' => 'New, Potential',
                'contact_notes' => 'Expressed interest in premium service.',
                'contact_internalnotes' => 'Introduced by John Doe.',
                'link' => 'http://example.com/contact/jane-smith',
                'link_description' => 'LinkedIn Profile',
                'last_use' => Carbon::now(),
            ],
            [
                'contact_first_name' => 'Alex',
                'contact_last_name' => 'Johnson',
                'contact_nif' => '555666777C',
                'contact_address' => '789 Third Ave, Othercity',
                'contact_country' => 'Elsewhere',
                'contact_mobile' => '+1234567892',
                'contact_mobile_2' => '+0987654323',
                'contact_email' => 'alex.johnson@example.com',
                'contact_email_2' => 'a.johnson@example.com',
                'social_link' => 'http://linkedin.com/in/alexjohnson',
                'contact_tags' => 'Consultant, Freelancer',
                'contact_notes' => 'Interested in collaboration.',
                'contact_internalnotes' => 'Has valuable industry contacts.',
                'link' => 'http://example.com/contact/alex-johnson',
                'link_description' => 'Business Website',
                'last_use' => Carbon::now(),
            ]
        ]);
    }
}
