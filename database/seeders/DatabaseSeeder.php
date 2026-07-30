<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    // Seed the application's database.
    public function run(): void
    {
        // 1. Manajer Keuangan (Role: manager)
        User::updateOrCreate(
            ['email' => 'manager@posfinance.co.id'],
            [
                'name' => 'Manajer Keuangan',
                'role' => 'manager',
                'position' => 'Manajer Keuangan',
                'department' => 'Regional 4 Semarang',
                'password' => bcrypt('password'),
            ]
        );

        // Keep legacy admin login working with manager role
        User::updateOrCreate(
            ['email' => 'admin@posfinance.co.id'],
            [
                'name' => 'Manajer Keuangan PosFinance',
                'role' => 'manager',
                'position' => 'Manajer Keuangan Utama',
                'department' => 'Regional 4 Semarang',
                'password' => bcrypt('password'),
            ]
        );

        // 2. Staff Keuangan (Role: staff)
        User::updateOrCreate(
            ['email' => 'staff@posfinance.co.id'],
            [
                'name' => 'Staff Keuangan',
                'role' => 'staff',
                'position' => 'Staff Entry Data Keuangan',
                'department' => 'Regional 4 Semarang',
                'password' => bcrypt('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Staff Operasional',
                'role' => 'staff',
                'position' => 'Staff Input Transaksi',
                'department' => 'Regional 4 Semarang',
                'password' => bcrypt('password'),
            ]
        );

        // 3. Supervisor / Auditor Keuangan (Role: supervisor)
        User::updateOrCreate(
            ['email' => 'irfan@posfinance.co.id'],
            [
                'name' => 'Irfan (Supervisor Keuangan)',
                'role' => 'supervisor',
                'position' => 'Supervisor / Auditor Keuangan',
                'department' => 'Regional 4 Semarang',
                'password' => bcrypt('password'),
            ]
        );

        $this->call([
            UnitSeeder::class,
            FinanceSeeder::class,
            RevenueStreamSeeder::class,
            AuditLogSeeder::class,
        ]);
    }
}
