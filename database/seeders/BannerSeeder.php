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
                'title' => 'Best Seller Hajatan',
                'subtitle' => 'Brownies panggang dengan lapisan atas krispi mengkilap & tekstur fudgy legit.',
                'badge_text' => 'Best Seller Hajatan',
                'image' => 'uploads/banners/1786511077_best-seller-hajatan.webp',
                'button_text' => 'Pesan via WA',
                'button_link' => 'https://wa.me/6285257220335',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Favorit Keluarga',
                'subtitle' => 'Kulit pastry berlapis renyah disisi pisang manis & keju gurih khas 99 Bakery.',
                'badge_text' => 'Favorit Keluarga',
                'image' => 'uploads/banners/1786511106_favorit-keluarga.webp',
                'button_text' => 'Katalog Lengkap',
                'button_link' => '/produk',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Fresh Every Day',
                'subtitle' => 'Tekstur empuk, wangi mentega alami, dibuat fresh setiap pagi.',
                'badge_text' => 'Fresh Every Day',
                'image' => 'uploads/banners/1786511180_fresh-every-day.webp',
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
