<?php

namespace App\Http\Controllers;

use App\Models\Penagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PenagihanController extends Controller
{
    public function index()
    {
        $penagihan = Penagihan::latest()->paginate(10); // 10 data per halaman
        return view('penagihan.index', compact('penagihan'));
    }

    public function create()
    {
        return view("penagihan.create");
    }

    public function take()
    {
        return view("penagihan.take");
    }

    public function preview()
    {
        return view("penagihan.preview");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'nomor_kredit' => 'required|numeric|min:10',
            'nama_debitur' => 'required|string|min:3',
            'no_telepon' => [
                'required',
                'regex:/^0[0-9]{7,}$/'
            ],
            'address' => 'required|string',
            'hasil_kunjungan' => 'required|string',
            'uraian_kunjungan' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $penagihanData = $request->only([
            'lat', 'lng', 'nomor_kredit', 'nama_debitur', 
            'no_telepon', 'address', 'hasil_kunjungan', 'uraian_kunjungan','image'
        ]);
        
        $penagihanData['by_user'] = Auth::id();

        Penagihan::create($penagihanData);

        return redirect()->route('penagihan.index')->with('success', 'Data berhasil disimpan.');
    }

    public function detail($uuid)
    {
        $data = Penagihan::where('uuid', $uuid)->firstOrFail();
        return view('penagihan.detail', compact('data'));
    }
}
