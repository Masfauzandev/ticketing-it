<?php

namespace Database\Seeders;

use App\Models\Ticketing\TicketCategory;
use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Hardware', 'description' => 'Masalah perangkat keras (PC, laptop, printer, dll)'],
            ['name' => 'Software', 'description' => 'Masalah aplikasi atau sistem operasi'],
            ['name' => 'Jaringan', 'description' => 'Masalah koneksi internet, VPN, atau jaringan lokal'],
            ['name' => 'Email', 'description' => 'Masalah email kantor atau konfigurasi email'],
            ['name' => 'Akses & Akun', 'description' => 'Permintaan akses, reset password, atau masalah akun'],
            ['name' => 'Lainnya', 'description' => 'Permintaan atau masalah IT lainnya'],
        ];

        foreach ($categories as $category) {
            TicketCategory::firstOrCreate(['name' => $category['name']], $category);
        }
    }
}
