<?php

namespace App\Http\Controllers;

use App\Models\Penagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PenagihanController extends Controller
{
    public function index()
    {
        $penagihan = Penagihan::whereNull('deleted_at')
            ->latest()
            ->paginate(10);
    
        return view('penagihan.index', compact('penagihan'));
    }

    public function create()
    {
        return view("penagihan.create");
    }

    public function take()
    {
        $penagihan = null;
    
        if (request()->has('edit') && Str::isUuid(request('edit'))) {
            $penagihan = Penagihan::where('uuid', request('edit'))->first();
        }
    
        return view("penagihan.take", compact('penagihan'));
    }
    

    public function preview()
    {
        return view("penagihan.preview");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            "uraian_kunjungan" => "required|string|min:10",
        ]);
    
        $penagihan = Penagihan::where('uuid', $uuid)->firstOrFail();
    
        // Update kolom tambahan jika ada perubahan
        $extraFields = ['image', 'image1', 'image2', 'image3', 'janji_bayar'];
        foreach ($extraFields as $field) {
            if ($request->filled($field) && $request->$field !== $penagihan->$field) {
                $validated[$field] = $request->$field;
            }
        }
    
        $penagihan->update($validated);
    
        return redirect()
            ->route('penagihan.detail', $uuid)
            ->with('showSuccessModal', true); // ⬅ ini akan trigger modal di halaman detail
    }
    
    

    public function destroy($uuid)
    {
        $penagihan = Penagihan::where('uuid', $uuid)->firstOrFail();

        // Soft delete jika model pakai SoftDeletes
        $penagihan->delete();

        return redirect()->route('penagihan.index')
            ->with('success', 'Data penagihan berhasil dihapus.');
    }


    public function snapshot($image)
    {
        return view('penagihan.snapshot', ['image' => $image]);
    }
    
}
