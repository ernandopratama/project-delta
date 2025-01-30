<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasienCheckupResep extends Model
{
    protected $fillable = [
        'pasien_checkup_id',
        'obat_id',
        'obat',
        'qty',
    ];

    public function pasienCheckup() {
        return $this->belongsTo(PasienCheckup::class);
    }
}
