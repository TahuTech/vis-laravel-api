<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class knn extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_balita', 'u', 'bb', 'tb', 'lkkepala', 'bulan', 'gizi', 'berat', 'tinggi', 'stunting'
    ];
}
