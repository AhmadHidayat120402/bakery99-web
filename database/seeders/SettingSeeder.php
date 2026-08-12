<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'topbar_announcement' => '🎁 Spesialis Roti Hajatan & Snack Box Jember • Fresh Setiap Hari • Pesan via WA:',
            'topbar_phone' => '0852-5722-0335',
            'company_name' => '99 Bakery Jember',
            'company_tagline' => 'Spesialis Roti Hajatan, Kue & Snackbox Fresh Every Day',
            'company_address' => 'Jl. Dharmawangsa No.64, Jubung, Tawang Alun, Jember',
            'company_email' => '99bakeryjember@gmail.com',
            'company_phone' => '0852-5722-0335',
            'social_instagram' => 'https://www.instagram.com/99bakeryjember/',
            'social_tiktok' => 'https://www.tiktok.com/@99bakeryjember',
        ];

        foreach ($settings as $key => $val) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $val]
            );
        }
    }
}
