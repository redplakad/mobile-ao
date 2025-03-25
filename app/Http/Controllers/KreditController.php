<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KreditController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $totalRow = Kredit::count(); // Hitung total semua row tanpa pagination
        
        return view('nominatif.index', compact('user', 'totalRow'));
    }
    // app/Http/Controllers/NominatifController.php

    public function showByBranch($branch_code, Request $request)
    {
        $user = Auth::user();
        $datadate = "2025-03-24";
        // Ambil daftar unik dari AO, Produk, dan Instansi
        $listAO = Kredit::where("datadate", $datadate)->where('CAB',$user->branch?->branch_code)->select('AO')->distinct()->pluck('AO');
        $listProduk = Kredit::where("datadate", $datadate)->where('CAB',$user->branch?->branch_code)->select('KET_KD_PRD')->distinct()->pluck('KET_KD_PRD');
        $listInstansi = Kredit::where("datadate", $datadate)->where('CAB',$user->branch?->branch_code)->select('TEMPAT_BEKERJA')->distinct()->pluck('TEMPAT_BEKERJA');

        $query = Kredit::where('datadate', $datadate);

        if ($request->filled('kolektibilitas')) {
            $query->where('KODE_KOLEK', $request->kolektibilitas);
        }
    
        if ($request->filled('ao')) {
            $query->where('AO', $request->ao);
        }
    
        if ($request->filled('produk')) {
            $query->where('KET_KD_PRD', $request->produk);
        }
    
        if ($request->filled('instansi')) {
            $query->where('TEMPAT_BEKERJA', $request->instansi);
        }
    
        $kredit = $query->paginate(10);

        // Kirim ke view
        return view('nominatif.branch', compact('user','kredit', 'listAO', 'listProduk', 'listInstansi'));
    }

}
