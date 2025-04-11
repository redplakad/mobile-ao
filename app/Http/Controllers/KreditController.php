<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Kredit;
use App\Models\UserActivity;
use App\Models\RekapPerkol;
use App\Models\RekapPerProduk;
use App\Models\PageView;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Exports\RecapByKolExport;
use App\Http\Controllers\Exports\RecapByProdukExport;

use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class KreditController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::user();
        $selectedCab = $request->query("cab", $user->branch?->branch_code);

        $datadate = request('datadate');

        if (!$datadate) {
            $datadate = Kredit::where('CAB', $selectedCab)
                ->latest('DATADATE')
                ->value('DATADATE');
        }

        $selectedCabName = Branch::where("branch_code", $selectedCab)->first();
        $selectedCabName = ucwords(strtolower($selectedCabName->branch_name));

        $url = $request->path(); // Menyimpan URL tanpa query string

        // Ambil latest datadate dari cache atau database
        $latestDate = Cache::remember(
            "kredit_latest_datadate",
            now()->addMinutes(60),
            function () {
                return Kredit::orderBy("datadate", "desc")->value("datadate");
            }
        );

        // Ambil selected datadate, defaultnya adalah latestDate
        $selectedDatadate = $request->query("datadate", $latestDate);

        // Ambil daftar cabang dari cache atau database
        $cabs = Cache::remember(
            "kredit_cabs",
            now()->addMinutes(60),
            function () {
                return Kredit::distinct()->pluck("CAB");
            }
        );

        // Periksa apakah ada data yang sesuai dengan cab dan datadate
        $dataExists = Cache::remember(
            "kredit_data_exists_{$selectedCab}_{$selectedDatadate}",
            now()->addMinutes(60),
            function () use ($selectedCab, $selectedDatadate) {
                return Kredit::where("CAB", $selectedCab)
                    ->where("datadate", $selectedDatadate)
                    ->exists();
            }
        );

        
        $routes = [
            'nominatif.cabang',
            'nominatif.rekap.kol',
            'nominatif.rekap.produk',
            'nominatif.rekap.ao',
        ];
        
        $pageViews = collect($routes)->mapWithKeys(fn($route) => [$route => PageView::getRouteStats($route)]);
        
        $cabangAvatars = $pageViews['nominatif.cabang']['avatars'] ?? [];
        $cabangTotalHit = $pageViews['nominatif.cabang']['totalHit'] ?? 0;
        
        $kolAvatars = $pageViews['nominatif.rekap.kol']['avatars'] ?? [];
        $kolTotalHit = $pageViews['nominatif.rekap.kol']['totalHit'] ?? 0;
        
        $produkAvatars = $pageViews['nominatif.rekap.produk']['avatars'] ?? [];
        $produkTotalHit = $pageViews['nominatif.rekap.produk']['totalHit'] ?? 0;
        
        $aoAvatars = $pageViews['nominatif.rekap.ao']['avatars'] ?? [];
        $aoTotalHit = $pageViews['nominatif.rekap.ao']['totalHit'] ?? 0;
        
        $instansiAvatars = $pageViews['nominatif.rekap.instansi']['avatars'] ?? [];
        $instansiTotalHit = $pageViews['nominatif.rekap.instansi']['totalHit'] ?? 0;        

        return view(
            "nominatif.index",
            compact(
                "selectedCab",
                "selectedCabName",
                "selectedDatadate",
                "user",
                "cabs",
                "datadate",
                "dataExists",
                "latestDate",
                'cabangAvatars',
                'cabangTotalHit',
                'kolAvatars',
                'kolTotalHit',
                'produkAvatars',
                'produkTotalHit',
                'aoAvatars',
                'aoTotalHit',
                'instansiAvatars',
                'instansiTotalHit'
            )
        );
    }
    // app/Http/Controllers/NominatifController.php

    public function showByBranch($branch_code, Request $request)
    {
        $user = Auth::user();
        $datadate = request('datadate');

        if (!$datadate) {
            $datadate = Kredit::where('CAB', $branch_code)
                ->latest('DATADATE')
                ->value('DATADATE');
        }

        $selectedCab = $branch_code;
        $selectedCabName = Branch::where("branch_code", $selectedCab)->first();
        $selectedCabName = ucwords(strtolower($selectedCabName->branch_name));
        $branchCode = $branch_code;

        // Ambil daftar unik AO, Produk, dan Instansi tanpa cache
        $listAO = Kredit::where("datadate", $datadate)
            ->where("CAB", $branchCode)
            ->distinct()
            ->pluck("AO");

        $listProduk = Kredit::where("datadate", $datadate)
            ->where("CAB", $branchCode)
            ->distinct()
            ->pluck("KET_KD_PRD");

        $listInstansi = Kredit::where("datadate", $datadate)
            ->where("CAB", $branchCode)
            ->distinct()
            ->pluck("TEMPAT_BEKERJA");

        // Query utama selalu menyertakan `datadate`
        $query = Kredit::where("datadate", $datadate)->where(
            "CAB",
            $selectedCab
        );

        // Filter berdasarkan input dari request
        if ($request->filled("kolektibilitas")) {
            $query->where("KODE_KOLEK", $request->kolektibilitas);
        }

        if ($request->filled("ao")) {
            $query->where("AO", urldecode($request->ao));
        }

        if ($request->filled("produk")) {
            $query->where("KET_KD_PRD", urldecode($request->produk));
        }

        if ($request->filled("instansi")) {
            $query->where("TEMPAT_BEKERJA", urldecode($request->instansi));
        }

        // Filter pencarian pada beberapa field
        if ($request->filled("q")) {
            $search = $request->q;
            $query->where(function ($query) use ($search) {
                $query
                    ->where("NAMA_NASABAH", "like", "%$search%")
                    ->orWhere("NOREK", "like", "%$search%");
            });
        }

        // Gunakan cache untuk paginasi agar query tidak berulang-ulang
        $cacheKey =
            "kredit_paginate_{$branchCode}_{$datadate}_" .
            md5(json_encode($request->all()));
        $kredit = Cache::remember(
            $cacheKey,
            now()->addMinutes(10),
            function () use ($query) {
                return $query->paginate(10);
            }
        );

        // Kirim ke view
        return view(
            "nominatif.branch",
            compact(
                "user",
                "kredit",
                "listAO",
                "listProduk",
                "listInstansi",
                "selectedCab",
                "selectedCabName",
                "datadate"
            )
        );
    }

    public function recapByKol($branch_code, Request $request)
    {
        $datadate = $request->input('datadate', now()->toDateString());
    
        // Cek jika data sudah ada di database
        $rekapExists = RekapPerkol::where('CAB', $branch_code)
            ->where('datadate', $datadate)
            ->exists();
    
        if ($rekapExists) {
            $recapData = RekapPerkol::where('CAB', $branch_code)
                ->where('datadate', $datadate)
                ->get();
            
            $sumDeb = $recapData->sum('total_count');
            $sumBaki = $recapData->sum('total_sum');
            $sumNPL = $recapData->first()?->total_npl ?? 1;
            $nplPercentage = $recapData->avg('npl_persentase');
        } else {
            $cacheKey = "recap_by_kol_{$branch_code}_{$datadate}";
            $recapData = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($branch_code, $datadate) {
                return Kredit::select('KODE_KOLEK')
                    ->selectRaw('COUNT(*) as total_count, SUM(POKOK_PINJAMAN) as total_sum')
                    ->where('datadate', $datadate)
                    ->where('CAB', $branch_code)
                    ->groupBy('KODE_KOLEK')
                    ->get();
            });
    
            $sumDeb = $recapData->sum('total_count');
            $sumBaki = $recapData->sum('total_sum');
            $sumNPL = $recapData->where('KODE_KOLEK', '>', 2)->sum('total_sum');
            $nplPercentage = $sumBaki > 0 ? ($sumNPL / $sumBaki) * 100 : 0;
    
            foreach ($recapData as $data) {
                RekapPerkol::updateOrCreate(
                    [
                        'CAB' => $branch_code,
                        'datadate' => $datadate,
                        'KODE_KOLEK' => $data->KODE_KOLEK,
                    ],
                    [
                        'total_count' => $data->total_count,
                        'total_sum' => $data->total_sum,
                        'total_npl' => $sumNPL,
                        'npl_persentase' => $nplPercentage,
                    ]
                );
            }
        }
    
        return view('nominatif.rekap.kolektibilitas', compact(
            'recapData',
            'sumBaki',
            'sumDeb',
            'sumNPL',
            'nplPercentage',
            'branch_code',
            'datadate'
        ));
    }    

    public function recapByProduk($branch_code, Request $request)
    {
        $datadate = $request->input('datadate', now()->toDateString());
        $cacheKey = "recap_by_produk_{$branch_code}_{$datadate}";
    
        $recapData = cache()->remember($cacheKey, now()->addHours(2), function () use ($branch_code, $datadate) {
            return Kredit::select('KET_KD_PRD')
                ->selectRaw('COUNT(*) as total_count')
                ->selectRaw('SUM(POKOK_PINJAMAN) as total_sum')
                ->selectRaw('SUM(CASE WHEN KODE_KOLEK > 2 THEN POKOK_PINJAMAN ELSE 0 END) as npl_sum')
                ->where('datadate', $datadate)
                ->where('CAB', $branch_code)
                ->groupBy('KET_KD_PRD')
                ->orderByDesc('total_sum')
                ->get();
        });
    
        [$sumDeb, $sumBaki, $sumNPL] = [
            $recapData->sum('total_count'),
            $recapData->sum('total_sum'),
            $recapData->sum('npl_sum'),
        ];
    
        return view('nominatif.rekap.produk', compact(
            'recapData',
            'sumDeb',
            'sumBaki',
            'sumNPL',
            'branch_code',
            'datadate'
        ));
    }
    

    public function recapByProdukDetail($branch_code, Request $request)
    {
        $prd = urldecode($request->input('produk'));
        $datadate = $request->input('datadate', now()->toDateString());
        $cacheKey = "recap_produk_detail_{$branch_code}_{$datadate}_{$prd}";
    
        $recapData = cache()->remember($cacheKey, now()->addHours(2), function () use ($branch_code, $datadate) {
            return Kredit::select('KET_KD_PRD', 'KODE_KOLEK')
                ->selectRaw('COUNT(*) as total_count')
                ->selectRaw('SUM(POKOK_PINJAMAN) as total_sum')
                ->selectRaw('SUM(CASE WHEN KODE_KOLEK > 2 THEN POKOK_PINJAMAN ELSE 0 END) as npl_sum')
                ->where([
                    ['datadate', '=', $datadate],
                    ['CAB', '=', $branch_code],
                ])
                ->groupBy('KET_KD_PRD', 'KODE_KOLEK')
                ->get()
                ->groupBy('KET_KD_PRD');
        });
    
        [$sumDeb, $sumBaki, $sumNPL] = [
            $recapData->flatten()->sum('total_count'),
            $recapData->flatten()->sum('total_sum'),
            $recapData->flatten()->sum('npl_sum'),
        ];
    
        return view('nominatif.rekap.produkDetail', compact(
            'recapData',
            'sumDeb',
            'sumBaki',
            'sumNPL',
            'branch_code',
            'datadate'
        ));
    }

    public function recapByAo($branch_code, Request $request)
    {
        $datadate = $request->input('datadate', now()->toDateString());
        $cacheKey = "recap_by_ao_{$branch_code}_{$datadate}";

        $recapData = cache()->remember($cacheKey, now()->addHours(2), function () use ($branch_code, $datadate) {
            return Kredit::select('AO')
                ->selectRaw('COUNT(*) as total_count')
                ->selectRaw('SUM(POKOK_PINJAMAN) as total_sum')
                ->selectRaw('SUM(CASE WHEN KODE_KOLEK > 2 THEN POKOK_PINJAMAN ELSE 0 END) as npl_sum')
                ->where('datadate', $datadate)
                ->where('CAB', $branch_code)
                ->groupBy('AO')
                ->orderByDesc('total_sum')
                ->get();
        });

        [$sumDeb, $sumBaki, $sumNPL] = [
            $recapData->sum('total_count'),
            $recapData->sum('total_sum'),
            $recapData->sum('npl_sum'),
        ];

        return view('nominatif.rekap.ao', compact(
            'recapData',
            'sumDeb',
            'sumBaki',
            'sumNPL',
            'branch_code',
            'datadate'
        ));
    }

    public function recapByAoDetail($branch_code, Request $request)
    {
        $ao = urldecode($request->input('produk'));
        $datadate = $request->input('datadate', now()->toDateString());
        $cacheKey = "recap_ao_detail_{$branch_code}_{$datadate}_{$ao}";

        $recapData = cache()->remember($cacheKey, now()->addHours(2), function () use ($branch_code, $datadate) {
            return Kredit::select('AO', 'KODE_KOLEK')
                ->selectRaw('COUNT(*) as total_count')
                ->selectRaw('SUM(POKOK_PINJAMAN) as total_sum')
                ->selectRaw('SUM(CASE WHEN KODE_KOLEK > 2 THEN POKOK_PINJAMAN ELSE 0 END) as npl_sum')
                ->where([
                    ['datadate', '=', $datadate],
                    ['CAB', '=', $branch_code],
                ])
                ->groupBy('AO', 'KODE_KOLEK')
                ->get()
                ->groupBy('AO');
        });

        [$sumDeb, $sumBaki, $sumNPL] = [
            $recapData->flatten()->sum('total_count'),
            $recapData->flatten()->sum('total_sum'),
            $recapData->flatten()->sum('npl_sum'),
        ];

        return view('nominatif.rekap.aoDetail', compact(
            'recapData',
            'sumDeb',
            'sumBaki',
            'sumNPL',
            'branch_code',
            'datadate'
        ));
    }

    public function recapByInstansiView($branch_code, Request $request)
    {
        $datadate = $request->input('datadate', now()->toDateString());
    
        $cacheKey = "recap_by_tempat_bekerja_{$branch_code}_{$datadate}";
        $recapData = cache()->remember($cacheKey, now()->addHours(2), function () use ($branch_code, $datadate) {
            return Kredit::select('TEMPAT_BEKERJA')
                ->selectRaw('COUNT(*) as total_count')
                ->selectRaw('SUM(POKOK_PINJAMAN) as total_sum')
                ->selectRaw('SUM(CASE WHEN KODE_KOLEK > 2 THEN POKOK_PINJAMAN ELSE 0 END) as npl_sum')
                ->where('datadate', $datadate)
                ->where('CAB', $branch_code)
                ->groupBy('TEMPAT_BEKERJA')
                ->orderByDesc('total_sum')
                ->get();
        });
    
        $sumDeb = $recapData->sum('total_count');
        $sumBaki = $recapData->sum('total_sum');
        $sumNPL = $recapData->sum('npl_sum');
    
        return view('nominatif.rekap.instansi', compact(
            'recapData',
            'sumDeb',
            'sumBaki',
            'sumNPL',
            'branch_code',
            'datadate'
        ));
    }
    public function recapByInstansiData($branch_code, Request $request)
    {
        $datadate = $request->input('datadate', now()->toDateString());
        $cacheKey = "recap_by_tempat_bekerja_{$branch_code}_{$datadate}";

        $query = cache()->remember($cacheKey, now()->addHours(2), function () use ($branch_code, $datadate) {
            return Kredit::select('TEMPAT_BEKERJA')
                ->selectRaw('COUNT(*) as total_count')
                ->selectRaw('SUM(POKOK_PINJAMAN) as total_sum')
                ->selectRaw('SUM(CASE WHEN KODE_KOLEK > 2 THEN POKOK_PINJAMAN ELSE 0 END) as npl_sum')
                ->where('datadate', $datadate)
                ->where('CAB', $branch_code)
                ->groupBy('TEMPAT_BEKERJA')
                ->orderByDesc('total_sum')
                ->get();
        });

        return DataTables::of($query)
            ->addColumn('TEMPAT_BEKERJA_LINK', function ($data) use ($branch_code, $datadate) {
                return route('nominatif.cabang', [
                    'branch_code' => $branch_code, 
                    'datadate' => $datadate,
                    'instansi' => urlencode($data->TEMPAT_BEKERJA),
                    'recap' => 'nominatif.rekap.instansi'
                ]);
            })
            ->addColumn('DETAIL_LINK', function ($data) use ($branch_code, $datadate) {
                return route('nominatif.rekap.instansi.detail', [
                    'branch_code' => $branch_code,
                    'datadate' => $datadate,
                    'instansi' => urlencode($data->TEMPAT_BEKERJA),
                    'recap' => 'nominatif.rekap.instansi'
                ]);
            })
            ->make(true);
    }
        

    public function recapByInstansiDetail($branch_code, Request $request)
    {
        $tempatBekerja = urldecode($request->input('produk'));
        $datadate = $request->input('datadate', now()->toDateString());
        $cacheKey = "recap_instansi_detail_{$branch_code}_{$datadate}_{$tempatBekerja}";

        $recapData = cache()->remember($cacheKey, now()->addHours(2), function () use ($branch_code, $datadate) {
            return Kredit::select('TEMPAT_BEKERJA', 'KODE_KOLEK')
                ->selectRaw('COUNT(*) as total_count')
                ->selectRaw('SUM(POKOK_PINJAMAN) as total_sum')
                ->selectRaw('SUM(CASE WHEN KODE_KOLEK > 2 THEN POKOK_PINJAMAN ELSE 0 END) as npl_sum')
                ->where([
                    ['datadate', '=', $datadate],
                    ['CAB', '=', $branch_code],
                ])
                ->groupBy('TEMPAT_BEKERJA', 'KODE_KOLEK')
                ->get()
                ->groupBy('TEMPAT_BEKERJA');
        });

        [$sumDeb, $sumBaki, $sumNPL] = [
            $recapData->flatten()->sum('total_count'),
            $recapData->flatten()->sum('total_sum'),
            $recapData->flatten()->sum('npl_sum'),
        ];

        return view('nominatif.rekap.instansiDetail', compact(
            'recapData',
            'sumDeb',
            'sumBaki',
            'sumNPL',
            'branch_code',
            'datadate'
        ));
    }

    /* Download ke excel */
    
    public function downloadRecapKol($branch_code, Request $request)
    {
        $branchName = match ($branch_code) {
            '000' => 'KANTOR PUSAN NON OPERASIONAL',
            '001' => 'KANTOR PUSAT OPERASIONAL',
            '002' => 'KANTOR CABANG KASEMEN',
            '003' => 'KANTOR CABANG ANYAR',
            '004' => 'KANTOR CABANG CINANGKA',
            '005' => 'KANTOR CABANG PONTANG',
            '006' => 'KANTOR CABANG CARENANG',
            '007' => 'KANTOR CABANG KRAGILAN',
            default => 'UNKNOWN',
        };

        $datadate = $request->input('datadate', now()->toDateString());
        $fileName = "rekap_kol_{$branch_code}_{$datadate}.xlsx";

        return Excel::download(new RecapByKolExport($branch_code, $datadate, $branchName), $fileName);

    }

    public function downloadRecapProduk($branch_code, Request $request)
    {
        $datadate = $request->input('datadate', now()->toDateString());
        $fileName = "rekap_produk_{$branch_code}_{$datadate}.xlsx";

        return Excel::download(new RecapByProdukExport($branch_code, $datadate), $fileName);
    }
}
