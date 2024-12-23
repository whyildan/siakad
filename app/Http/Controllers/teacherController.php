<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class teacherController extends Controller
{
    public function dataguru()
    {
        try {

            $gurus = Teacher::with('user')->get();
            return view('teacher.index', compact('gurus'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dimuat😵');
        }
    }

    public function tambahguru()
    {
        return view('teacher.add', ['hideNavbar' => true]);
    }

    public function createteacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone_number' => 'required|string|max:13|regex:/^[0-9]+$/',
            'address' => 'required|string',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'teacher', // Pastikan role diset sebagai "guru"
            ]);

            // Simpan data guru
            Teacher::create([
                'user_id' => $user->id,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);

            return redirect('/teacher')->with('sukses', 'Data Berhasil Ditambah🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Ditambah😵');
        }
    }

    public function editguru($id)
    {
        $guru = Teacher::with('user')->findOrFail($id);
        return view('teacher.update', ['hideNavbar' => true], compact('guru'));
    }

    public function updateteacher(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'phone_number' => 'required|string|max:13|regex:/^[0-9]+$/',
            'address' => 'required|string',
        ]);

        try {
            // Ambil data guru
            $guru = Teacher::findOrFail($id);

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
                'phone_number' => $request->phone_number,
                'address' => $request->address,
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
            $guru = Teacher::findOrFail($id);

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