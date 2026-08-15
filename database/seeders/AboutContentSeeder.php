<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use Illuminate\Database\Seeder;

class AboutContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutContent::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Solusi Roti Fresh & Terpercaya',
                'tagline' => 'Komitmen Kualitas 100% Halal & Fresh Daily',
                'hero_subtitle' => 'Mengenal perjalanan 99 Bakery Jember dalam menghadirkan roti hajatan, brownies, bolen, dan kue basah berkualitas tinggi dengan kehangatan rasa keluarga.',
                'description' => "**99 Bakery Jember** adalah usaha kuliner spesialis toko roti dan kue yang berfokus pada penyediaan **Roti Hajatan, Snackbox Syukuran, Brownies, Bolen, Kue Basah, Dessert, dan Kue Tart**.\n\nDengan tekad untuk selalu memberikan yang terbaik bagi setiap pelanggan, kami senantiasa menggunakan bahan-bahan pilihan bermutu tinggi tanpa pengawet berbahaya, diolah secara higienis oleh tenaga berpengalaman, serta selalu disajikan fresh baked setiap hari.",
                'store_photo' => null,
                'halal_logo' => null,
            ]
        );
    }
}
