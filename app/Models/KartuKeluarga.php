<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function wargas()
    {
        return $this->hasMany(Warga::class);
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class);
    }
}
