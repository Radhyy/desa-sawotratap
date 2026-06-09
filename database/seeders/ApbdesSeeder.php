<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApbdesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Apbdes::create([
            'year' => '2026',
            'target_amount' => 1450000000,
            'realization_amount' => 1258000000,
            'pie_belanja' => 45,
            'pie_pendapatan' => 35,
            'pie_pembiayaan' => 20,
            'chart_months' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            'chart_pendapatan' => [220, 240, 260, 210, 230, 250],
            'chart_belanja' => [180, 200, 190, 185, 195, 210],
            'chart_surplus' => [40, 40, 70, 25, 35, 40],
            'is_active' => true,
        ]);
    }
}
