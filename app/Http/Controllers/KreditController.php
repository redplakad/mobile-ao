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
        $kredit = Kredit::paginate(10); // Ambil data dengan pagination (10 per halaman)
        $totalRow = Kredit::count(); // Hitung total semua row tanpa pagination
        
        return view('nominatif.index', compact('user','kredit', 'totalRow'));
    }
    // app/Http/Controllers/NominatifController.php

    public function showByBranch($branch_code)
    {
        // Ambil data berdasarkan branch_code
        $nominatifs = Kredit::where('CAB', $branch_code)->paginate(15);

        // Hitung total debitur
        $totalRow = $nominatifs->count();

        // Kirim ke view
        return view('nominatif.branch', compact('nominatifs', 'branch_code', 'totalRow'));
    }

}
