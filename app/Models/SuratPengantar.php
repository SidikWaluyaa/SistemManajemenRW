<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratPengantar extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
