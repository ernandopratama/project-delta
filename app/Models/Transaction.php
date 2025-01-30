<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'pasien_checkup_id',
        'apoteker_id',
        'total_price',
        'status',
    ];

    public function pasienCheckup() {
        return $this->belongsTo(PasienCheckup::class);
    }

    public function apoteker() {
        return $this->belongsTo(User::class, 'apoteker_id');
    }

    public function details() {
        return $this->hasMany(TransactionDetail::class);
    }
}
