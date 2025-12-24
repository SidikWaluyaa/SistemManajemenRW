<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    // Relation
    public function user() { return $this->belongsTo(User::class); }
    public function kategori() { return $this->belongsTo(KategoriTransaksi::class, 'kategori_transaksi_id'); }
    public function warga() { return $this->belongsTo(Warga::class); }
}
