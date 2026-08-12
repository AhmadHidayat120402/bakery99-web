<?php

namespace Database\Seeders;

use App\Models\ProductBadge;
use Illuminate\Database\Seeder;

class ProductBadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'id' => 1,
                'name' => 'Best Seller',
                'bg_color' => '#B78103', // Emas / Gold
                'text_color' => '#FFFFFF',
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Terlaris',
                'bg_color' => '#C62828', // Merah 99 Bakery
                'text_color' => '#FFFFFF',
                'is_active' => true,
            ],
            [
                'id' => 3,
                'name' => 'Favorit',
                'bg_color' => '#E65100', // Oranye Warm
                'text_color' => '#FFFFFF',
                'is_active' => true,
            ],
            [
                'id' => 4,
                'name' => 'Fresh Daily',
                'bg_color' => '#2E7D32', // Hijau Segar
                'text_color' => '#FFFFFF',
                'is_active' => true,
            ],
            [
                'id' => 5,
                'name' => 'Spesial',
                'bg_color' => '#6A1B9A', // Ungu
                'text_color' => '#FFFFFF',
                'is_active' => true,
            ],
            [
                'id' => 6,
                'name' => 'New Arrival',
                'bg_color' => '#1565C0', // Biru
                'text_color' => '#FFFFFF',
                'is_active' => true,
            ],
        ];

        foreach ($badges as $badge) {
            ProductBadge::updateOrCreate(['id' => $badge['id']], $badge);
        }
    }
}
