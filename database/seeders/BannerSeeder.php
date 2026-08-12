<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Bolu Gulung Topping Keju Gondrong',
                'subtitle' => 'Bolu gulung lembut beralaskan keju cheddar melimpah untuk momen spesial keluarga.',
                'badge_text' => 'SPESIAL BOLEH DICOBA',
                'image' => 'img/products/Bolu/gulung hias keju.jpg',
                'button_text' => 'Lihat Produk',
                'button_link' => '/produk',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Fudgy Brownies Shiny Crust Original',
                'subtitle' => 'Brownies panggang dengan lapisan atas krispi mengkilap & tekstur fudgy legit.',
                'badge_text' => 'BEST SELLER HAJATAN',
                'image' => 'img/products/Brownies/panggang box.jpg',
                'button_text' => 'Pesan via WA',
                'button_link' => 'https://wa.me/6285257220335',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Bolen Pisang Keju Renyah',
                'subtitle' => 'Kulit pastry berlapis renyah disisi pisang manis & keju gurih khas 99 Bakery.',
                'badge_text' => 'FAVORIT KELUARGA',
                'image' => 'img/products/Bolen/bolen box.png',
                'button_text' => 'Katalog Lengkap',
                'button_link' => '/produk',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Roti Sobek Soft & Fresh',
                'subtitle' => 'Tekstur empuk, wangi mentega alami, dibuat fresh setiap pagi.',
                'badge_text' => 'FRESH EVERY DAY',
                'image' => 'img/products/roti/Sobek pisang.jpg',
                'button_text' => 'Lihat Pilihan',
                'button_link' => '/produk',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $b) {
            Banner::updateOrCreate(
                ['title' => $b['title']],
                $b
            );
        }
    }
}
