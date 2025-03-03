<?php

namespace App\Http\Controllers;

use App\Models\Penagihan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenagihanController extends Controller
{
    //
    public function index()
    {
        return view("penagihan.index");
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
        'lat' => 'required|numeric',
        'lng' => 'required|numeric',
        'nomor_kredit' => 'required|string',
        'nama_debitur' => 'required|string',
        'no_telepon' => 'required|string',
        'address' => 'required|string',
        'hasil_kunjungan' => 'required|string',
        'uraian_kunjungan' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $penagihan = new Penagihan();
    $penagihan->lat = $request->lat;
    $penagihan->lng = $request->lng;
    $penagihan->nomor_kredit = $request->nomor_kredit;
    $penagihan->nama_debitur = $request->nama_debitur;
    $penagihan->no_telepon = $request->no_telepon;
    $penagihan->address = $request->address;
    $penagihan->hasil_kunjungan = $request->hasil_kunjungan;
    $penagihan->uraian_kunjungan = $request->uraian_kunjungan;
    $penagihan->by_user = Auth::id();

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageData = base64_encode(file_get_contents($image->path()));
        $penagihan->image = $imageData;
    }

    $penagihan->save();

    return redirect()->route('penagihan.index')->with('success', 'Data berhasil disimpan.');
}
}
