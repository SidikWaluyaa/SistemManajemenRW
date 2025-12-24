<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define casts for dates if needed
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class);
    }

    public function suratPengantars()
    {
        return $this->hasMany(SuratPengantar::class);
    }
}
