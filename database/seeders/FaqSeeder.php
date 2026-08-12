<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara melakukan pemesanan roti di 99 Bakery?',
                'answer' => 'Pemesanan sangat mudah! Anda cukup memilih produk di katalog web ini, klik tombol "Pesan via WhatsApp", lalu Anda akan langsung terhubung ke admin WhatsApp outlet pilihan Anda.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Berapa H-minimal pesan roti untuk acara hajatan besar / snackbox banyak?',
                'answer' => 'Untuk pemesanan dalam jumlah besar (di atas 50 box/pcs), disarankan pesan H-2 atau H-1 sebelum acara agar tim kami dapat menyiapkan bahan fresh maksimal.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah roti dan kue 99 Bakery dijamin Halal dan Fresh?',
                'answer' => 'Ya, 100% Halal Indonesia (sertifikat Halal terlampir) dan semua produk diproduksi fresh setiap hari tanpa bahan pengawet berbahaya.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah melayani pengiriman area Jember dan sekitarnya?',
                'answer' => 'Tentu! Kami melayani pengiriman langsung via Kurir 99 Bakery maupun pengiriman ojek online untuk wilayah Jember dan sekitarnya.',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }
    }
}
