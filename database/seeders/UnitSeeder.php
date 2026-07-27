<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    // Run the database seeds.
    public function run(): void
    {
        $units = [
            [
                'code' => 'U1',
                'name' => 'Kantor Pos Utama Semarang (Pleburan)',
                'description' => 'Jl. Pleburan / Semarang Selatan',
                'category' => 'Kantor Pos Utama',
                'person_in_charge' => 'Kepala Kantor Pos Semarang',
                'status' => 'Active',
            ],
            [
                'code' => 'U2',
                'name' => 'Unit Kurir & Kargo Express',
                'description' => 'Pengiriman Paket & Logistik Semarang',
                'category' => 'Kurir & Logistik',
                'person_in_charge' => 'Manajer Kurir & Kargo',
                'status' => 'Active',
            ],
            [
                'code' => 'U3',
                'name' => 'Unit Layanan PosPay & Jasa Keuangan',
                'description' => 'Pembayaran, Remitansi & Keuangan',
                'category' => 'Jasa Keuangan',
                'person_in_charge' => 'Manajer Jasa Keuangan',
                'status' => 'Active',
            ],
            [
                'code' => 'U4',
                'name' => 'Unit Keagenan & Loket Mitra',
                'description' => 'Kemitraan Agen Pos Semarang Selatan',
                'category' => 'Kemitraan',
                'person_in_charge' => 'Supervisor Keagenan',
                'status' => 'Active',
            ],
            [
                'code' => 'U5',
                'name' => 'Unit Logistik & Pergudangan',
                'description' => 'Manajemen Pergudangan & Supply Chain',
                'category' => 'Logistik',
                'person_in_charge' => 'Supervisor Pergudangan',
                'status' => 'Active',
            ],
        ];

        foreach ($units as $unitData) {
            Unit::updateOrCreate(
                ['code' => $unitData['code']],
                $unitData
            );
        }
    }
}
