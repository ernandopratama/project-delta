<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MedicineService
{
    public $baseUrl = 'http://recruitment.rsdeltasurya.com/api/v1/';

    public function auth() {
        $data = Http::post($this->baseUrl . 'auth', [
            'email' => 'ernandopratama45@gmail.com',
            'password' => '081335368268',
        ]);

        if($data->successful()) {
            return $data->json();
        }
    }

    public function medicines() {
        $data = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->auth()['access_token'],
        ])->get($this->baseUrl . 'medicines');

        if($data->successful()) {
            return $data->json();
        }
    }

    public function getMeidicinePrice($id) {
        $data = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->auth()['access_token'],
        ])->get($this->baseUrl . 'medicines/' . $id . '/prices');

        if($data->successful()) {
            return $data->json();
        }
    }
}
