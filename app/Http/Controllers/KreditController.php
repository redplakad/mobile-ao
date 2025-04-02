<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Kredit;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class KreditController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user();
        $selectedCab = $request->query('cab', $user->branch?->branch_code);
        $selectedCabName = Branch::where('branch_code', $selectedCab)->first();
        $selectedCabName = ucwords(strtolower($selectedCabName->branch_name));
        
        $url = $request->path(); // Menyimpan URL tanpa query string
        $totalHit = UserActivity::where('url', 'like', "{$url}%")->count();

        // Ambil latest datadate dari cache atau database
        $latestDate = Cache::remember('kredit_latest_datadate', now()->addMinutes(60), function () {
            return Kredit::orderBy('datadate', 'desc')->value('datadate');
        });
        
        // Ambil selected datadate, defaultnya adalah latestDate
        $selectedDatadate = $request->query('datadate', $latestDate);
        
        // Ambil daftar cabang dari cache atau database
        $cabs = Cache::remember('kredit_cabs', now()->addMinutes(60), function () {
            return Kredit::distinct()->pluck('CAB');
        });
        
        // Ambil daftar tanggal unik dari cache atau database
        $datadates = Cache::remember('kredit_datadates', now()->addMinutes(60), function () {
            return Kredit::distinct()->pluck('datadate')
                ->map(fn($date) => \Carbon\Carbon::parse($date)->format('Y-m-d'))
                ->toArray();
        });
        
        // Periksa apakah ada data yang sesuai dengan cab dan datadate
        $dataExists = Cache::remember("kredit_data_exists_{$selectedCab}_{$selectedDatadate}", now()->addMinutes(60), function () use ($selectedCab, $selectedDatadate) {
            return Kredit::where('CAB', $selectedCab)
                ->where('datadate', $selectedDatadate)
                ->exists();
        });
        return view('nominatif.index', compact('selectedCab','selectedCabName', 'selectedDatadate', 'user', 'cabs', 'datadates', 'dataExists', 'latestDate', 'totalHit'));
    }
    // app/Http/Controllers/NominatifController.php

    public function showByBranch($branch_code, Request $request)
    {
        $user = Auth::user();
        $datadate = request('datadate', '2025-03-24');
        $selectedCab = $branch_code;
        $selectedCabName = Branch::where('branch_code', $selectedCab)->first();
        $selectedCabName = ucwords(strtolower($selectedCabName->branch_name));
        $branchCode = $branch_code;
        
        // Ambil daftar unik AO, Produk, dan Instansi tanpa cache
        $listAO = Kredit::where('datadate', $datadate)
                        ->where('CAB', $branchCode)
                        ->distinct()
                        ->pluck('AO');

        $listProduk = Kredit::where('datadate', $datadate)
                            ->where('CAB', $branchCode)
                            ->distinct()
                            ->pluck('KET_KD_PRD');

        $listInstansi = Kredit::where('datadate', $datadate)
                            ->where('CAB', $branchCode)
                            ->distinct()
                            ->pluck('TEMPAT_BEKERJA');

        
        // Query utama selalu menyertakan `datadate`
        $query = Kredit::where('datadate', $datadate)
                        ->where('CAB', $selectedCab);
        
        // Filter berdasarkan input dari request
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
        
        // Filter pencarian pada beberapa field
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($query) use ($search) {
                $query->where('NAMA_NASABAH', 'like', "%$search%")
                    ->orWhere('NOREK', 'like', "%$search%");
            });
        }
        
        // Gunakan cache untuk paginasi agar query tidak berulang-ulang
        $cacheKey = "kredit_paginate_{$branchCode}_{$datadate}_" . md5(json_encode($request->all()));
        $kredit = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($query) {
            return $query->paginate(10);
        });

        // Kirim ke view
        return view('nominatif.branch', compact('user','kredit', 'listAO', 'listProduk', 'listInstansi', 'selectedCab', 'selectedCabName'));
    }

}
