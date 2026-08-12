<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Roti Hajatan & Snack Box',
                'slug' => 'roti-hajatan-snack-box',
                'image' => 'uploads/categories/1786510832_roti-hajatan-snack-box.webp',
                'icon' => 'bi-box-seam-fill',
                'description' => 'Paket hemat & hantaran acara syukuran, rapat & pernikahan.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Aneka Roti',
                'slug' => 'aneka-roti',
                'image' => 'uploads/categories/1786510847_aneka-roti.webp',
                'icon' => 'bi-bag-heart-fill',
                'description' => 'Roti sisir, roti sobek & roti isi lembut aromatik.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Brownies & Bolu',
                'slug' => 'brownies-bolu',
                'image' => 'uploads/categories/1786510875_brownies-bolu.webp',
                'icon' => 'bi-cake2-fill',
                'description' => 'Fudgy brownies shiny crust & bolu gulung keju melimpah.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Aneka Bolen',
                'slug' => 'aneka-bolen',
                'image' => 'uploads/categories/1786510890_aneka-bolen.webp',
                'icon' => 'bi-pie-chart-fill',
                'description' => 'Bolen pisang keju & coklat melted ber-pastry renyah.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Donat & Dessert',
                'slug' => 'donat-dessert',
                'image' => 'uploads/categories/1786511037_donat-dessert.webp',
                'icon' => 'bi-cup-hot-fill',
                'description' => 'Donat kentang glaze assorted & dessert box red velvet.',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Kue Basah',
                'slug' => 'kue-basah',
                'image' => 'uploads/categories/1786511011_kue-basah.webp',
                'icon' => 'bi-grid-fill',
                'description' => 'Aneka kue tradisional & modern higienis berkualitas.',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Kue Tart',
                'slug' => 'kue-tart',
                'image' => 'uploads/categories/1786511019_kue-tart.webp',
                'icon' => 'bi-gift-fill',
                'description' => 'Kue tart ulang tahun & spiku lapis hiasan custom cantik.',
                'sort_order' => 7,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $cat) {
            ProductCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
