<?php

namespace App\Http\Controllers;

use App\Models\PasienCheckup;
use App\Models\PasienCheckupResep;
use App\Services\MedicineService;
use Illuminate\Http\Request;

class DokterResepController extends Controller
{
    public $medicines = [];

    public function __construct(public MedicineService $medicineService) {
        $this->medicines = $this->medicineService->medicines()['medicines'];
    }

    public function index(Request $request, $checkupId) {
        // Check data
        $checkup = PasienCheckup::find($checkupId);
        if(!$checkup) {
            session()->flash('error', 'Data not found');
            return redirect()->back();
        }
        // Check status
        if($checkup->status == 1) {
            session()->flash('error', 'Data is being processed');
            return redirect()->back();
        }

        $title = 'Resep Dokter';
        $perPage = $request->per_page ?? 10;
        $search = $request->search ?? '';
        // Paginate data
        $get = PasienCheckupResep::where('pasien_checkup_id', $checkupId)->where(function($query) use ($search) {
            $query->orWhere('obat_id', 'like', "%$search%");
            $query->orWhere('obat', 'like', "%$search%");
            $query->orWhere('qty', 'like', "%$search%");
        })->paginate($perPage);
        $medicines = $this->medicines;

        return view('web.dokter-resep', compact('get', 'medicines', 'checkupId', 'title'));
    }

    public function show($id) {
        $get = PasienCheckupResep::find($id);
        return response()->json($get);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'pasien_checkup_id' => 'required',
            'obat_id' => 'required',
            'qty' => 'required',
        ]);
        $obat = explode('|', $validated['obat_id']);
        $validated['obat_id'] = $obat[0];
        $validated['obat'] = $obat[1];

        PasienCheckupResep::create($validated);

        session()->flash('success', 'Resep Dokter created successfully');
        return redirect()->back();
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'pasien_checkup_id' => 'required',
            'obat_id' => 'required',
            'qty' => 'required',
        ]);

        $obat = explode('|', $validated['obat_id']);
        $validated['obat_id'] = $obat[0];
        $validated['obat'] = $obat[1];

        PasienCheckupResep::find($id)->update($validated);

        session()->flash('success', 'Resep Dokter updated successfully');
        return redirect()->back();
    }

    public function delete($id) {
        $model = PasienCheckupResep::find($id);

        if($model->status == 1) {
            session()->flash('error', 'Data is being processed');
            return redirect()->back();
        }

        $model->delete();
        session()->flash('success', 'Resep Dokter deleted successfully');
        return redirect()->back();
    }
}
