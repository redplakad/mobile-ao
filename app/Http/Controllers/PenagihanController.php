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
        return view("penagihan.index", compact("penagihan"));
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
            "image" => "required",
            "lat" => "required|numeric",
            "lng" => "required|numeric",
            "nomor_kredit" => "required|numeric|min:10",
            "nama_debitur" => "required|string|min:3",
            "no_telepon" => ["required", 'regex:/^0[0-9]{7,}$/'],
            "address" => "required|string",
            "hasil_kunjungan" => "required|string",
            "uraian_kunjungan" => "required|string|min:10",
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $penagihanData = $request->only([
            "lat",
            "lng",
            "nomor_kredit",
            "nama_debitur",
            "no_telepon",
            "address",
            "hasil_kunjungan",
            "janji_bayar",
            "uraian_kunjungan",
            "image",
        ]);

        $penagihanData["by_user"] = Auth::id();

        Penagihan::create($penagihanData);

        return redirect()
            ->route("penagihan.index")
            ->with("success", "Data berhasil disimpan.");
    }

    public function detail($uuid)
    {
        $data = Penagihan::where("uuid", $uuid)->firstOrFail();
        return view("penagihan.detail", compact("data"));
    }

    public function edit($uuid)
    {
        $penagihan = Penagihan::where('uuid', $uuid)->firstOrFail();
        return view("penagihan.edit", compact("penagihan"));
    }

    public function update(Request $request, $uuid)
    {
        $validated = $request->validate([
            "nomor_kredit" => "required|numeric|min:10",
            "nama_debitur" => "required|string|min:3",
            "no_telepon" => ["required", 'regex:/^0[0-9]{7,}$/'],
            "hasil_kunjungan" => "required|string",
            "janji_bayar" => "required|string",
            "uraian_kunjungan" => "required|string|min:10",
        ]);
    
        $penagihan = Penagihan::where('uuid', $uuid)->firstOrFail();
        $penagihan->update($validated);
    
        return redirect()->route('penagihan.index')->with('success', 'Data penagihan berhasil diperbarui.');
    }
    
}
