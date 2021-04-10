<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    protected $table = 'peminjam';
    protected $fillable = ['id_peminjam','NIS','tanggal_peminjam','tanggal_kembali','status','denda','id_buku'];
}
