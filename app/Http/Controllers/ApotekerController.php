<?php

namespace App\Http\Controllers;

use App\Models\PasienCheckup;
use App\Models\Transaction;
use App\Services\MedicineService;
use Illuminate\Http\Request;

class ApotekerController extends Controller
{
    public function __construct(public MedicineService $medicineService) { }

    public function index(Request $request) {
        $title = 'Transaksi';
        $perPage = $request->per_page ?? 10;
        $search = $request->search ?? '';
        // Paginate data
        $get = Transaction::with('pasienCheckup')->where(function($query) use ($search) {
            $query->orWhere('total_price', 'like', "%$search%");
            $query->orWhereHas('pasienCheckup', function($query) use ($search) {
                $query->orWhere('pasien', 'like', "%$search%");
                $query->orWhere('checkup_at', 'like', "%$search%");
            });
        })->paginate($perPage);
        $pasienCheckup = PasienCheckup::where('status', 0)->get();

        return view('web.apoteker', compact('get', 'pasienCheckup', 'title'));
    }

    public function pdf($id) {
        $get = Transaction::find($id);
        return view('web.exports.transaction', compact('get'));
    }

    public function show($id) {
        $get = Transaction::find($id);
        return response()->json($get);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'pasien_checkup_id' => 'required|exists:pasien_checkups,id',
        ]);
        $validated['apoteker_id'] = auth()->id();
        $validated['total_price'] = 0;
        $validated['status'] = 0;

        // Check pasien checkup
        $pasienCheckup = PasienCheckup::find($validated['pasien_checkup_id']);
        $transaction = Transaction::create($validated);

        // Create transaction detail
        $totalPrice = 0;
        foreach ($pasienCheckup->resep as $resep) {
            $prices = collect($this->medicineService->getMeidicinePrice($resep->obat_id)['prices']);

            // Get current price
            $currentPrice = $prices->first(function ($item) {
                return $item['end_date']['value'] == now()->format('Y-m-d') || $item['end_date']['value'] > now()->format('Y-m-d');
            });

            $totalPrice += $currentPrice['unit_price'];

            $transaction->details()->create([
                'pasien_checkup_resep_id' => $resep->id,
                'price' => $currentPrice['unit_price'],
            ]);
        }

        // Update pasien checkup
        $pasienCheckup->update([
            'status' => 1,
        ]);

        // Update total price
        $transaction->update([
            'total_price' => $totalPrice,
        ]);


        session()->flash('success', 'Transaction created successfully');
        return redirect()->back();
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'pasien_checkup_id' => 'required|exists:pasien_checkups,id',
        ]);

        $transaction = Transaction::find($id);

        // Delete transaction detail
        $transaction->details()->delete();

        // Check pasien checkup
        $pasienCheckup = PasienCheckup::find($validated['pasien_checkup_id']);

        // Create transaction detail
        $totalPrice = 0;
        foreach ($pasienCheckup->resep as $resep) {
            $prices = collect($this->medicineService->getMeidicinePrice($resep->obat_id)['prices']);

            // Get current price
            $currentPrice = $prices->first(function ($item) {
                return $item['end_date']['value'] == now()->format('Y-m-d') || $item['end_date']['value'] > now()->format('Y-m-d');
            });

            $totalPrice += $currentPrice['unit_price'];

            $transaction->details()->create([
                'pasien_checkup_resep_id' => $resep->id,
                'price' => $currentPrice['unit_price'],
            ]);
        }

        // Update pasien checkup
        $pasienCheckup->update([
            'status' => 1,
        ]);

        // Update total price
        $validated['total_price'] = $totalPrice;
        $transaction->update($validated);
        session()->flash('success', 'Transaction updated successfully');
        return redirect()->back();
    }

    public function delete($id) {
        $transaction = Transaction::find($id);

        // Reset status pasien checkup
        $transaction->pasienCheckup->update([
            'status' => 0,
        ]);

        $transaction->delete();
        session()->flash('success', 'Transaction deleted successfully');
        return redirect()->back();
    }
}
