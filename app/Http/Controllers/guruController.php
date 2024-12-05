<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;

class guruController extends Controller
{
    public function dataguru()
    {
        try {

            $gurus = Guru::with('user')->get();
            return view('manajemen-guru.guru', compact('gurus'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dimuat😵');
        }
    }

    public function tambahguru()
    {
        return view('manajemen-guru.tambah-guru', ['hideNavbar' => true]);
    }

    public function createteacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'telepon' => 'required|string|max:13|regex:/^[0-9]+$/',
            'alamat' => 'required|string',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'guru', // Pastikan role diset sebagai "guru"
            ]);

            // Simpan data guru
            Guru::create([
                'user_id' => $user->id,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
            ]);

            return redirect('/teacher')->with('sukses', 'Data Berhasil Ditambah🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Ditambah😵');
        }
    }

    public function editguru($id)
    {
        $guru = Guru::with('user')->findOrFail($id);
        return view('manajemen-guru.edit-guru', ['hideNavbar' => true], compact('guru'));
    }

    public function updateteacher(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'telepon' => 'required|string|max:13|regex:/^[0-9]+$/',
            'alamat' => 'required|string',
        ]);

        try {
            // Ambil data guru
            $guru = Guru::findOrFail($id);

            // Update data user
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            // Periksa jika password diisi
            if ($request->filled('password')) {
                $userData['password'] = bcrypt($request->password);
            }

            $guru->user->update($userData);

            // Update data guru
            $guru->update([
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
            ]);

            return redirect('/teacher')->with('sukses', 'Data Sukses Diedit🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Diedit😵');
        }
    }

    public function hapusguru($id)
    {
        try {
            // Ambil data guru
            $guru = Guru::findOrFail($id);

            // Hapus data guru
            $guru->delete();

            // Hapus data user terkait
            $guru->user->delete();

            return back()->with('sukses', 'Data Berhasil Dihapus🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dihapus😵');
        }
    }
}