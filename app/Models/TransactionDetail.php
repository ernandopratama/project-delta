<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id',
        'pasien_checkup_resep_id',
        'price',
    ];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }

    public function pasienCheckupResep() {
        return $this->belongsTo(PasienCheckupResep::class);
    }
}
