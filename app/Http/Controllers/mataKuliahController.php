<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    public function index()
    {
        $matakuliah = MataKuliah::all();
        return view('mataKuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        return view('mataKuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk'   => 'required|unique:mata_kuliah,kode_mk',
            'nama_mk'   => 'required',
            'sks'       => 'required|numeric|min:1|max:6',
            'semester'  => 'required|numeric|min:1|max:8',
        ], [
            'kode_mk.required' => 'Kode mata kuliah wajib diisi.',
            'kode_mk.unique'   => 'Kode mata kuliah ini sudah terdaftar.',
            'nama_mk.required' => 'Nama mata kuliah tidak boleh kosong.',
            'sks.required'     => 'Jumlah SKS harus diisi.',
            'sks.max'          => 'SKS maksimal adalah 6.',
            'sks.numeric'      => 'SKS harus berupa angka.',
            'sks.min'          => 'SKS minimal adalah 1.',
            'semester.required' => 'Semester wajib diisi.',
            'semester.min'     => 'Semester minimal adalah 1.',
            'semester.max'     => 'Semester maksimal adalah 8.',
        ]);

        MataKuliah::create($request->only(['kode_mk', 'nama_mk', 'sks', 'semester']));;

        return redirect()->route('mataKuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $matakuliah = MataKuliah::findOrFail($id);
        return view('mataKuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_mk'  => 'required|unique:mata_kuliah,kode_mk,' . $id,
            'nama_mk'  => 'required',
            'sks'      => 'required|numeric|min:1|max:6',
            'semester' => 'required|numeric|min:1|max:8',
        ], [
            'kode_mk.required' => 'Kode mata kuliah wajib diisi.',
            'kode_mk.unique'   => 'Kode mata kuliah ini sudah digunakan oleh data lain.',
            'nama_mk.required' => 'Nama mata kuliah tidak boleh kosong.',
            'sks.required'     => 'Jumlah SKS harus diisi.',
            'semester.max'     => 'Batas maksimal semester adalah 8.',
        ]);

        $matakuliah = MataKuliah::findOrFail($id);
        $matakuliah->update($request->only(['kode_mk', 'nama_mk', 'sks', 'semester']));

        return redirect()->route('mataKuliah.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        MataKuliah::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}
