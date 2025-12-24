<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutasiWarga extends Model
{
    protected $guarded = ['id'];
    
    protected $casts = [
        'tanggal_mutasi' => 'date',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
