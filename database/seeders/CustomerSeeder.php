<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $is_msme = rand(0, 1);

            DB::table('customers')->insert([
                'uuid' => Str::uuid(),
                'customer_code' => 'GCS-' . rand(1000, 9999),
                'customer_name' => 'Customer ' . Str::random(5),
                'customer_type' => 'GCS',
                'customer_category' => 'Normal',
                'contact_person' => 'Person ' . Str::random(5),
                'mobile_no' => rand(1000000000, 9999999999),
                'email' => 'customer' . $i . '@example.com',
                'website' => 'www.example' . $i . '.com',
                'address_line_1' => 'Address Line 1',
                'state_id' => 1,
                'city_id' => 1,
                'area_id' => 1,
                'pincode' => '123456',
                'phone_1' => '1234567890',
                'gst' => 'GST' . Str::random(5),
                'pan' => 'PAN' . Str::random(5),
                'credit_days' => 30,
                'is_msme' => $is_msme,
                'msme_no' => $is_msme ? 'MSME-' . rand(10000, 99999) : null,
                'created_by' => 'Seeder',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
