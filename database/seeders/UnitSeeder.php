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
                'name' => 'Kantor Regional 4 Semarang (Sisingamangaraja)',
                'description' => 'Jl. Sisingamangaraja No.45, Wonotingal, Candisari, Semarang',
                'category' => 'Kantor Regional',
                'person_in_charge' => 'Kepala Kantor Regional 4',
                'status' => 'Active',
            ],
            [
                'code' => 'U2',
                'name' => 'Unit Kurir & Kargo Express Reg. 4',
                'description' => 'Pengiriman Paket & Kargo Logistik Regional 4 Semarang',
                'category' => 'Kurir & Logistik',
                'person_in_charge' => 'Manajer Kurir & Kargo',
                'status' => 'Active',
            ],
            [
                'code' => 'U3',
                'name' => 'Unit Layanan PosPay & Jasa Keuangan Reg. 4',
                'description' => 'Pembayaran, Remitansi & Keuangan Regional 4 Semarang',
                'category' => 'Jasa Keuangan',
                'person_in_charge' => 'Manajer Jasa Keuangan',
                'status' => 'Active',
            ],
            [
                'code' => 'U4',
                'name' => 'Unit Keagenan & Loket Mitra Reg. 4',
                'description' => 'Kemitraan Agen Pos Regional 4 Semarang',
                'category' => 'Kemitraan',
                'person_in_charge' => 'Supervisor Keagenan',
                'status' => 'Active',
            ],
            [
                'code' => 'U5',
                'name' => 'Unit Logistik & Pergudangan Reg. 4',
                'description' => 'Manajemen Pergudangan & Supply Chain Regional 4',
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
