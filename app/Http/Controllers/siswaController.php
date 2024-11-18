<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;

class siswaController extends Controller
{
    public function datasiswa()
    {
        try {
            $siswas = Siswa::with('kelas')->get();
            return view('manajemen-siswa.siswa', compact('siswas'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dimuat😵');
        }
    }

    public function tambahsiswa()
    {
        try {
            $kelas = Kelas::all();
            return view('manajemen-siswa.tambah-siswa', ['hideNavbar' => true], compact('kelas'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Form Gagal Dimuat😵');
        }
    }

    public function createstudent(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'required|string|max:13|regex:/^[0-9]+$/',
            'alamat' => 'required|string'
        ]);

        try {
            Siswa::create($validated);
            return redirect('/student')->with('sukses', 'Data Berhasil Ditambahkan🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', "Data Gagal Ditambahkan😵");
        }
    }

    public function editsiswa($id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return back()->with('gagal', 'Siswa Tidak Ditemukan😵');
        }

        $kelas = Kelas::all();
        return view('manajemen-siswa.edit-siswa', ['hideNavbar' => true], compact('siswa', 'kelas'));
    }

    public function updatestudent(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'required|string|max:13|regex:/^[0-9]+$/',
            'alamat' => 'required|string'
        ]);

        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->update($validated);

            return redirect('/student')->with('sukses', 'Data Berhasil Diedit🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', "Data Gagal Diedit😵");
        }
    }

    public function deletestudent($id)
    {
        try {
            Siswa::findOrFail($id);
            Siswa::destroy($id);

            return back()->with('sukses', 'Data Berhasil Dihapus🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dihapus😵');
        }
    }
}
