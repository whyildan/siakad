<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;

class siswaController extends Controller
{
    public function datasiswa()
    {
        try {
            $siswas = Siswa::with('kelas', 'user')->get();
            return view('manajemen-siswa.siswa', compact('siswas'));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return back()->with('gagal', "Data Gagal Dimuat😵, {$message}");
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
        $request->validate([
            'nama' => 'required|string',
            'nis' => 'required|string|max:16|unique:siswas,nis',
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'required|string|max:13|regex:/^[0-9]+$/',
            'alamat' => 'required|string',
            'orang_tua_nama' => 'required|string',
            'orang_tua_email' => 'required|email|unique:users,email',
            'orang_tua_password' => 'required|min:6',
        ]);

        try {
            // Simpan data user (orang tua) dengan role "orang_tua"
            $orangTua = User::create([
                'name' => $request->orang_tua_nama,
                'email' => $request->orang_tua_email,
                'password' => bcrypt($request->orang_tua_password),
                'role' => 'orang_tua', // Tambahkan role langsung
            ]);

            // Simpan data siswa
            Siswa::create([
                'nama' => $request->nama,
                'nis' => $request->nis,
                'kelas_id' => $request->kelas_id,
                'tanggal_lahir' => $request->tanggal_lahir,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'orang_tua_id' => $orangTua->id,
            ]);
            return redirect('/student')->with('sukses', 'Data Berhasil Ditambahkan🥳');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return back()->with('gagal', "Data Gagal Ditambahkan😵, {$message}");
        }
    }

    public function editsiswa($id)
    {
        try {
            $siswa = Siswa::with('user')->findOrFail($id);
            $kelas = Kelas::all();
            return view('manajemen-siswa.edit-siswa', ['hideNavbar' => true], compact('siswa', 'kelas'));
        } catch (\Exception $e) {
            return back()->with('gagal', "Data Tidak Ditemukan😵");
        }
    }

    public function updatestudent(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'nis' => 'required|string|max:16',
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'required|string|max:13|regex:/^[0-9]+$/',
            'alamat' => 'required|string',
            'orang_tua_nama' => 'required|string',
            'orang_tua_email' => 'required|email',
            'orang_tua_password' => 'nullable|min:6',
        ]);

        try {
            $siswa = Siswa::findOrFail($id);

            $siswa->update([
                'nama' => $request->nama,
                'nis' => $request->nis,
                'kelas_id' => $request->kelas_id,
                'tanggal_lahir' => $request->tanggal_lahir,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
            ]);

            // Update data orang tua
            $userData = [
                'name' => $request->orang_tua_nama,
                'email' => $request->orang_tua_email,
            ];

            if ($request->filled('password')) {
                $userData['password'] = bcrypt($request->orang_tua_password);
            }

            $siswa->user->update($userData);

            return redirect('/student')->with('sukses', 'Data Berhasil Diedit🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', "Data Gagal Diedit😵");
        }
    }

    public function deletestudent($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);

            $siswa->user->delete();

            $siswa->delete();

            return back()->with('sukses', 'Data Berhasil Dihapus🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dihapus😵');
        }
    }
}
