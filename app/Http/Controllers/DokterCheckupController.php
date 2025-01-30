<?php

namespace App\Http\Controllers;

use App\Models\PasienCheckup;
use App\Traits\WithMediaCollection;
use Illuminate\Http\Request;

class DokterCheckupController extends Controller
{
    use WithMediaCollection;

    public function index(Request $request) {
        $title = 'Pasien Checkup';
        $perPage = $request->per_page ?? 10;
        $search = $request->search ?? '';
        // Paginate data
        $get = PasienCheckup::with('media')->where(function($query) use ($search) {
            $query->orWhere('pasien', 'like', "%$search%");
            $query->orWhere('checkup_at', 'like', "%$search%");
            $query->orWhere('tinggi_badan', 'like', "%$search%");
            $query->orWhere('berat_badan', 'like', "%$search%");
            $query->orWhere('systole', 'like', "%$search%");
            $query->orWhere('diastole', 'like', "%$search%");
            $query->orWhere('heart_rate', 'like', "%$search%");
            $query->orWhere('respiration_rate', 'like', "%$search%");
            $query->orWhere('temperature', 'like', "%$search%");
            $query->orWhere('result', 'like', "%$search%");
            $query->orWhere('status', 'like', "%$search%");
        })->paginate($perPage);

        return view('web.dokter-checkup', compact('get', 'title'));
    }

    public function show($id) {
        $get = PasienCheckup::find($id);
        return response()->json($get);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'pasien' => 'required',
            'checkup_at' => 'required',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'systole' => 'required',
            'diastole' => 'required',
            'heart_rate' => 'required',
            'respiration_rate' => 'required',
            'temperature' => 'required',
            'result' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $model = PasienCheckup::create($validated);

        if($request->hasFile('file')) {
            $this->saveFile(
                model: $model,
                file: $request->file,
                collection: 'file',
            );
        }

        session()->flash('success', 'Checkup created successfully');
        return redirect()->back();
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'pasien' => 'required',
            'checkup_at' => 'required',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'systole' => 'required',
            'diastole' => 'required',
            'heart_rate' => 'required',
            'respiration_rate' => 'required',
            'temperature' => 'required',
            'result' => 'required',
        ]);

        $model = PasienCheckup::find($id);

        if($model->status == 1) {
            session()->flash('error', 'Data is being processed');
            return redirect()->back();
        }

        if($request->hasFile('file')) {
            $this->saveFile(
                model: $model,
                file: $request->file,
                collection: 'file',
            );
        }

        $model->update($validated);
        session()->flash('success', 'Checkup updated successfully');
        return redirect()->back();
    }

    public function delete($id) {
        $model = PasienCheckup::find($id);

        if($model->status == 1) {
            session()->flash('error', 'Data is being processed');
            return redirect()->back();
        }

        $model->delete();
        session()->flash('success', 'Checkup deleted successfully');
        return redirect()->back();
    }
}
