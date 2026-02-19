<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('matakuliah')->get();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        $matakuliah = Matakuliah::all();
        return view('mahasiswa.create', compact('matakuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim'      => 'required|max:20|unique:mahasiswa,nim',
            'nama'     => 'required|string|max:100',
            'kelas'    => 'required',
            'semester' => 'required|numeric|min:1|max:12',
            'bukti_pembayaran' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
            'matakuliah_id' => 'required|array',
            'matakuliah_id.*' => 'exists:mata_kuliah,id',
        ], [
            'nim.required'      => 'NIM tidak boleh kosong.',
            'nim.unique'        => 'NIM sudah terdaftar dalam sistem.',
            'nim.max'           => 'NIM maksimal 20 karakter.',
            'nama.required'     => 'Nama mahasiswa wajib diisi.',
            'kelas.required'    => 'Kelas wajib diisi.',
            'semester.required' => 'Semester wajib diisi.',
            'semester.numeric'  => 'Semester harus berupa angka.',
            'semester.min'      => 'Minimal semester adalah 1.',
            'semester.max'      => 'Maksimal semester adalah 12.',
            'matakuliah_id.required' => 'Pilih minimal satu mata kuliah.',
            'bukti_pembayaran.required' => 'Unggah bukti pembayaran.',
        ]);

        $data = $request->only([
            'nim',
            'nama',
            'kelas',
            'semester'
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pembayaran'), $filename);

            $data['bukti_pembayaran'] = $filename;
        }

        $mahasiswa = Mahasiswa::create($data);

        if ($request->has('matakuliah_id')) {
            $mahasiswa->matakuliah()->sync($request->matakuliah_id);
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa dan KRS berhasil disimpan!');
    }


    public function show($id)
    {
        $mahasiswa = Mahasiswa::with('matakuliah')->findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }


    public function edit($id)
    {
        $mahasiswa = Mahasiswa::with('matakuliah')->findOrFail($id);
        $matakuliah = MataKuliah::all();

        return view('mahasiswa.edit', compact('mahasiswa', 'matakuliah'));
    }


    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim'      => 'required|max:20|unique:mahasiswa,nim,' . $id,
            'nama'     => 'required|string|max:100',
            'kelas'    => 'required',
            'semester' => 'required|numeric|min:1|max:12',
            'matakuliah_id' => 'required|array',
        ], [
            'nim.required'      => 'NIM tidak boleh kosong.',
            'nim.unique'        => 'NIM sudah digunakan mahasiswa lain.',
            'nama.required'     => 'Nama mahasiswa wajib diisi.',
            'semester.max'      => 'Batas maksimal semester adalah 12.',
            'matakuliah_id.required' => 'Pilih minimal satu mata kuliah.',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $data = $request->only(['nim', 'nama', 'kelas', 'semester']);

        if ($request->hasFile('bukti_pembayaran')) {
            if ($mahasiswa->bukti_pembayaran && file_exists(public_path('uploads/pembayaran/' . $mahasiswa->bukti_pembayaran))) {
                unlink(public_path('uploads/pembayaran/' . $mahasiswa->bukti_pembayaran));
            }

            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pembayaran'), $filename);
            $data['bukti_pembayaran'] = $filename;
        }

        $mahasiswa->update($data);

        if ($request->has('matakuliah_id')) {
            $mahasiswa->matakuliah()->sync($request->matakuliah_id);
        } else {
            $mahasiswa->matakuliah()->detach();
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        if ($mahasiswa->bukti_pembayaran && file_exists(public_path('uploads/pembayaran/' . $mahasiswa->bukti_pembayaran))) {
            unlink(public_path('uploads/pembayaran/' . $mahasiswa->bukti_pembayaran));
        }

        $mahasiswa->matakuliah()->detach();
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus!');
    }
}
