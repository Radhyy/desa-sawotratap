<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Desa Sawotratap'],
            ['key' => 'site_description', 'value' => 'Website Resmi Pemerintah Desa Sawotratap, Kecamatan Gedangan, Kabupaten Sidoarjo.'],
            ['key' => 'contact_email', 'value' => 'info@sawotratap.desa.id'],
            ['key' => 'contact_phone', 'value' => '+62 812 3456 7890'],
            ['key' => 'contact_address', 'value' => 'Jl. Balai Desa No. 1, Sawotratap, Gedangan, Sidoarjo'],
            ['key' => 'facebook_url', 'value' => '#'],
            ['key' => 'instagram_url', 'value' => '#'],
            ['key' => 'youtube_url', 'value' => '#'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(['key' => $setting['key']], $setting);
        }
    }
}
