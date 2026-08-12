<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rotiHajatanCat = ProductCategory::where('slug', 'roti-hajatan-snack-box')->first();
        $anekaRotiCat = ProductCategory::where('slug', 'aneka-roti')->first();
        $browniesCat = ProductCategory::where('slug', 'brownies-bolu')->first();
        $bolenCat = ProductCategory::where('slug', 'aneka-bolen')->first();
        $donatCat = ProductCategory::where('slug', 'donat-dessert')->first();
        $kueBasahCat = ProductCategory::where('slug', 'kue-basah')->first();
        $kueTartCat = ProductCategory::where('slug', 'kue-tart')->first();

        $products = [
            // Roti Hajatan & Snack Box
            [
                'product_category_id' => $rotiHajatanCat->id ?? 1,
                'product_badge_id' => 1, // Best Seller
                'name' => 'Paket Roti Hajatan Spesial',
                'slug' => 'paket-roti-hajatan-spesial',
                'image' => 'img/products/roti/sobek coklat.jpg',
                'price' => 8000,
                'unit' => 'box',
                'description' => 'Kombinasi roti lembut pilihan & kue lezat yang dikemas cantik untuk berbagai konsumsi acara syukuran/pernikahan.',
                'is_best_seller' => true,
                'is_popular' => true,
                'is_active' => true,
            ],
            // Aneka Roti
            [
                'product_category_id' => $anekaRotiCat->id ?? 2,
                'product_badge_id' => 1, // Best Seller
                'name' => 'Roti Sobek Pisang Coklat',
                'slug' => 'roti-sobek-pisang-coklat',
                'image' => 'img/products/roti/Sobek pisang.jpg',
                'price' => 15000,
                'unit' => 'pack',
                'description' => 'Roti sobek lembut dengan isian pisang raja manis & coklat lelehan lumer di mulut. Favorit acara keluarga!',
                'is_best_seller' => true,
                'is_popular' => true,
                'is_active' => true,
            ],
            [
                'product_category_id' => $anekaRotiCat->id ?? 2,
                'product_badge_id' => 4, // Fresh Daily
                'name' => 'Roti Pizza Spesialis Sosis Besar',
                'slug' => 'roti-pizza-spesialis-sosis-besar',
                'image' => 'img/products/roti/Pizza besar.jpg',
                'price' => 18000,
                'unit' => 'pcs',
                'description' => 'Roti empuk dengan topping sosis ayam premium, saus keju gurih, dan taburan oregano segar.',
                'is_best_seller' => false,
                'is_popular' => true,
                'is_active' => true,
            ],
            // Brownies & Bolu
            [
                'product_category_id' => $browniesCat->id ?? 3,
                'product_badge_id' => 1, // Best Seller
                'name' => 'Fudgy Brownies Shiny Crust (Box)',
                'slug' => 'fudgy-brownies-shiny-crust-box',
                'image' => 'img/products/Brownies/panggang box.jpg',
                'price' => 35000,
                'unit' => 'box',
                'description' => 'Brownies panggang coklat asli dengan tekstur fudgy legit dan permukaan shiny crust yang krispi.',
                'is_best_seller' => true,
                'is_popular' => true,
                'is_active' => true,
            ],
            [
                'product_category_id' => $browniesCat->id ?? 3,
                'product_badge_id' => 3, // Favorit
                'name' => 'Bolu Gulung Keju Spesial',
                'slug' => 'bolu-gulung-keju-spesial',
                'image' => 'img/products/Bolu/gulung hias keju.jpg',
                'price' => 45000,
                'unit' => 'loyang',
                'description' => 'Bolu gulung super lembut berbahan dasar telur segar dengan taburan keju gondrong melimpah di luar dan dalam.',
                'is_best_seller' => true,
                'is_popular' => true,
                'is_active' => true,
            ],
            // Aneka Bolen
            [
                'product_category_id' => $bolenCat->id ?? 4,
                'product_badge_id' => 2, // Terlaris
                'name' => 'Bolen Pisang Keju Premium',
                'slug' => 'bolen-pisang-keju-premium',
                'image' => 'img/products/Bolen/bolen box.png',
                'price' => 30000,
                'unit' => 'box',
                'description' => 'Pastry berlapis renyah dengan isian pisang raja manis, keju cheddar parut melimpah, dan mentega wangi.',
                'is_best_seller' => true,
                'is_popular' => true,
                'is_active' => true,
            ],
            // Donat & Dessert
            [
                'product_category_id' => $donatCat->id ?? 5,
                'product_badge_id' => 4, // Fresh Daily
                'name' => 'Donat Kentang Glaze Assorted',
                'slug' => 'donat-kentang-glaze-assorted',
                'image' => 'img/products/Donat/donat topping.jpg',
                'price' => 6000,
                'unit' => 'pcs',
                'description' => 'Donat kentang empuk dengan varian topping mesis coklat, matcha, keju, dan glaze manis.',
                'is_best_seller' => false,
                'is_popular' => true,
                'is_active' => true,
            ],
            // Kue Basah
            [
                'product_category_id' => $kueBasahCat->id ?? 6,
                'product_badge_id' => 5, // Spesial
                'name' => 'Kue Basah Nampan Premium',
                'slug' => 'kue-basah-nampan-premium',
                'image' => 'img/products/Kue Basah/Pie Buah.png',
                'price' => 10000,
                'unit' => 'paket 3 kue',
                'description' => 'Aneka pilihan kue basah tradisional dan modern higienis (Lemper, Pastel, Risoles, Pie Buah).',
                'is_best_seller' => false,
                'is_popular' => true,
                'is_active' => true,
            ],
            // Kue Tart
            [
                'product_category_id' => $kueTartCat->id ?? 7,
                'product_badge_id' => 1, // Best Seller
                'name' => 'Kue Tart Birthday Classic',
                'slug' => 'kue-tart-birthday-classic',
                'image' => 'img/products/tart/378d5ea7-0433-4872-90ed-b7cc7e646d16.jpg',
                'price' => 85000,
                'unit' => 'ukuran 16cm',
                'description' => 'Kue ulang tahun dengan hiasan butter cream lembut, spiku lezat, dan hiasan custom cantik.',
                'is_best_seller' => true,
                'is_popular' => true,
                'is_active' => true,
            ],
        ];

        foreach ($products as $prod) {
            Product::updateOrCreate(
                ['slug' => $prod['slug']],
                $prod
            );
        }
    }
}
