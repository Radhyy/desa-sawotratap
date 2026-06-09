<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apbdes extends Model
{
    protected $fillable = [
        'year', 'target_amount', 'realization_amount',
        'pie_belanja', 'pie_pendapatan', 'pie_pembiayaan',
        'chart_months', 'chart_pendapatan', 'chart_belanja', 'chart_surplus',
        'is_active'
    ];

    protected $casts = [
        'chart_months' => 'array',
        'chart_pendapatan' => 'array',
        'chart_belanja' => 'array',
        'chart_surplus' => 'array',
        'is_active' => 'boolean',
    ];
}
