<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PasienCheckup extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'pasien',
        'checkup_at',
        'tinggi_badan',
        'berat_badan',
        'systole',
        'diastole',
        'heart_rate',
        'respiration_rate',
        'temperature',
        'result',
        'status',
    ];

    protected $casts = [
        'checkup_at' => 'datetime',
    ];

    public function resep() {
        return $this->hasMany(PasienCheckupResep::class);
    }
}
