<?php

namespace Database\Seeders;

use App\Models\RevenueStream;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class RevenueStreamSeeder extends Seeder
{
    public function run(): void
    {
        $units = Unit::all()->keyBy('code');

        $streams = [
            [
                'unit_code' => 'U2',
                'name' => 'Kurir & Kargo Express',
                'category' => 'Kurir & Logistik',
                'target_amount' => 135000000000.00,
                'realization_amount' => 143100000000.00,
                'contribution_percentage' => 58.00,
                'growth_rate' => 12.40,
                'period' => 'YTD 2026',
                'status' => 'Active',
            ],
            [
                'unit_code' => 'U3',
                'name' => 'Layanan PosPay & Keuangan',
                'category' => 'Jasa Keuangan',
                'target_amount' => 64000000000.00,
                'realization_amount' => 66600000000.00,
                'contribution_percentage' => 27.00,
                'growth_rate' => 8.70,
                'period' => 'YTD 2026',
                'status' => 'Active',
            ],
            [
                'unit_code' => 'U4',
                'name' => 'Keagenan & Loket Mitra',
                'category' => 'Kemitraan',
                'target_amount' => 38000000000.00,
                'realization_amount' => 37000000000.00,
                'contribution_percentage' => 15.00,
                'growth_rate' => 5.20,
                'period' => 'YTD 2026',
                'status' => 'Active',
            ],
            [
                'unit_code' => 'U5',
                'name' => 'Sewa Lahan & Properti Pos',
                'category' => 'Aset & Properti',
                'target_amount' => 18000000000.00,
                'realization_amount' => 18300000000.00,
                'contribution_percentage' => 7.40,
                'growth_rate' => 10.10,
                'period' => 'YTD 2026',
                'status' => 'Active',
            ],
            [
                'unit_code' => 'U3',
                'name' => 'Remitansi & Transfer Duit',
                'category' => 'Jasa Keuangan',
                'target_amount' => 24000000000.00,
                'realization_amount' => 25500000000.00,
                'contribution_percentage' => 10.30,
                'growth_rate' => 6.80,
                'period' => 'YTD 2026',
                'status' => 'Active',
            ],
        ];

        foreach ($streams as $data) {
            $unitCode = $data['unit_code'];
            unset($data['unit_code']);

            $unit = $units->get($unitCode) ?? $units->first();

            if ($unit) {
                RevenueStream::updateOrCreate(
                    [
                        'name' => $data['name'],
                        'unit_id' => $unit->id,
                    ],
                    array_merge($data, ['unit_id' => $unit->id])
                );
            }
        }
    }
}
