<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;

class PegawaiController extends Controller
{
    /**
     * Menampilkan daftar pegawai dengan fitur filter dan pencarian.
     */
    public function index(Request $request)
    {
        $query = Pegawai::query();

        if ($request->filled('q')) {
            $query->where('nama_pegawai', 'like', '%' . $request->q . '%');
        }
        if ($request->filled('pendidikan')) {
            $query->where('pendidikan_terakhir', $request->pendidikan);
        }
        if ($request->filled('gender')) {
            $query->where('jenis_kelamin', $request->gender);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pegawai = $query->latest()->paginate(10)->withQueryString();
        
        $editPegawai = null;
        if ($request->has('edit')) {
            $editPegawai = Pegawai::find($request->edit);
        }

        return view('pegawai.index', compact('pegawai', 'editPegawai'));
    }

    public function create()
    {
        return redirect()->route('pegawai.index');
    }

    /**
     * Menyimpan data pegawai (Validasi dipindah ke StorePegawaiRequest).
     */
    public function store(StorePegawaiRequest $request)
    {
        // Data sudah otomatis tervalidasi di sini!
        Pegawai::create($request->validated());
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    public function edit($id)
    {
        return redirect()->route('pegawai.index', ['edit' => $id]);
    }

    /**
     * Memperbarui data pegawai (Validasi dipindah ke UpdatePegawaiRequest).
     */
    public function update(UpdatePegawaiRequest $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        
        // Data sudah otomatis tervalidasi di sini!
        $pegawai->update($request->validated());
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus!');
    }
}