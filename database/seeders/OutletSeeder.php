<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $outlets = [
            [
                'name' => 'Outlet Tawang Alun (Pusat)',
                'slug' => 'tawang-alun',
                'address' => 'Jl. Dharmawangsa No.64, Jubung, Tawang Alun, Jember (Depan Terminal Tawang Alun)',
                'phone_whatsapp' => '0852-5722-0335',
                'google_maps_url' => 'https://maps.google.com/?q=99+Bakery+Tawang+Alun+Jember',
                'operating_hours' => 'Setiap Hari (07.00 - 21.00 WIB)',
                'image' => 'img/outlet.webp',
                'is_main' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Outlet Kampus Sumbersari',
                'slug' => 'kampus-sumbersari',
                'address' => 'Jl. Kalimantan No.45, Sumbersari, Area Kampus UNEJ, Jember',
                'phone_whatsapp' => '0852-8491-1654',
                'google_maps_url' => 'https://maps.google.com/?q=99+Bakery+Kampus+Jember',
                'operating_hours' => 'Setiap Hari (07.00 - 21.00 WIB)',
                'image' => 'img/outlet.webp',
                'is_main' => false,
                'is_active' => true,
            ],
        ];

        foreach ($outlets as $out) {
            Outlet::updateOrCreate(
                ['slug' => $out['slug']],
                $out
            );
        }
    }
}
