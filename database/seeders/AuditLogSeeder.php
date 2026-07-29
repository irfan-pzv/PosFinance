<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AuditLogSeeder extends Seeder
{
    // Seed sample audit log entries.
    public function run(): void
    {
        $admin = User::where('email', 'admin@posfinance.co.id')->first() ?? User::first();

        if (!$admin) {
            return;
        }

        $logs = [
            [
                'action' => 'LOGIN',
                'description' => 'Pengguna berhasil login ke dalam sistem POS Finance.',
                'minutes_ago' => 5,
            ],
            [
                'action' => 'UPDATE_PROFILE',
                'description' => 'Pengguna memperbarui informasi nama dan jabatan profil.',
                'minutes_ago' => 25,
            ],
            [
                'action' => 'CREATE_UNIT',
                'description' => 'Menambahkan Unit Operasional baru "Unit Kurir & Logistik Reg. 4".',
                'minutes_ago' => 60,
            ],
            [
                'action' => 'CREATE_REVENUE',
                'description' => 'Menambahkan entri Revenue Stream baru sebesar Rp 450.000.000 (Layanan PosPay).',
                'minutes_ago' => 120,
            ],
            [
                'action' => 'CHANGE_PASSWORD',
                'description' => 'Pengguna melakukan pembaruan password keamanan akun.',
                'minutes_ago' => 300,
            ],
            [
                'action' => 'LOGIN',
                'description' => 'Pengguna berhasil masuk ke dashboard dari perangkat Windows.',
                'minutes_ago' => 1440,
            ],
            [
                'action' => 'UPDATE_UNIT',
                'description' => 'Memperbarui target RKAP Unit Kantor Regional 4 Semarang.',
                'minutes_ago' => 2880,
            ],
        ];

        foreach ($logs as $log) {
            AuditLog::create([
                'user_id' => $admin->id,
                'user_name' => $admin->name,
                'user_email' => $admin->email,
                'action' => $log['action'],
                'description' => $log['description'],
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/126.0.0.0 Safari/537.36',
                'created_at' => Carbon::now()->subMinutes($log['minutes_ago']),
                'updated_at' => Carbon::now()->subMinutes($log['minutes_ago']),
            ]);
        }
    }
}
