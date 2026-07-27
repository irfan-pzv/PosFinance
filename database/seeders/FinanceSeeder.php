<?php

namespace Database\Seeders;

use App\Models\Finance;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class FinanceSeeder extends Seeder
{
    // Run the database seeds.
    public function run(): void
    {
        $financialRecords = [
            'U1' => [
                'year' => 2026,
                'period' => 'YTD 2026',
                'target_rkap' => 85000000000.00,
                'realization' => 89200000000.00,
                'variance' => 4200000000.00,
                'achievement' => 104.94,
                'performance_status' => 'Sangat Baik',
                'notes' => 'Kinerja melampaui target RKAP berkat peningkatan transaksi surat & paket ekspres.',
            ],
            'U2' => [
                'year' => 2026,
                'period' => 'YTD 2026',
                'target_rkap' => 62000000000.00,
                'realization' => 65500000000.00,
                'variance' => 3500000000.00,
                'achievement' => 105.65,
                'performance_status' => 'Sangat Baik',
                'notes' => 'Pertumbuhan signifikan di sektor logistik & kargo korporasi.',
            ],
            'U3' => [
                'year' => 2026,
                'period' => 'YTD 2026',
                'target_rkap' => 48000000000.00,
                'realization' => 49100000000.00,
                'variance' => 1100000000.00,
                'achievement' => 102.29,
                'performance_status' => 'On Track',
                'notes' => 'Layanan transaksi PosPay dan remitansi dana berjalan stabil.',
            ],
            'U4' => [
                'year' => 2026,
                'period' => 'YTD 2026',
                'target_rkap' => 25000000000.00,
                'realization' => 24600000000.00,
                'variance' => -400000000.00,
                'achievement' => 98.40,
                'performance_status' => 'Perlu Perhatian',
                'notes' => 'Memerlukan edukasi & dorongan keagenan untuk optimalisasi pencapaian.',
            ],
            'U5' => [
                'year' => 2026,
                'period' => 'YTD 2026',
                'target_rkap' => 18000000000.00,
                'realization' => 18300000000.00,
                'variance' => 300000000.00,
                'achievement' => 101.67,
                'performance_status' => 'On Track',
                'notes' => 'Fasilitas pergudangan dan pemenuhan pesanan berkinerja sesuai target.',
            ],
        ];

        foreach ($financialRecords as $code => $financeData) {
            $unit = Unit::where('code', $code)->first();

            if ($unit) {
                Finance::updateOrCreate(
                    [
                        'unit_id' => $unit->id,
                        'year' => $financeData['year'],
                        'period' => $financeData['period'],
                    ],
                    array_merge($financeData, ['unit_id' => $unit->id])
                );
            }
        }
    }
}
