<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class userController extends Controller
{
    public function datauser()
    {
        try {
            $users = User::all();

            return view('manajemen-user.user', compact('users'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dimuat😵');
        }
    }

    public function tambahuser()
    {
        $roles = ['admin' => 'Admin', 'guru' => 'Guru', 'orang_tua' => 'Orang Tua'];
        return view('manajemen-user.tambah-user', ['hideNavbar' => true], compact('roles'));
    }

    public function createuser(Request $request)
    {
        try {
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required|in:admin,guru,orang_tua'
            ]);

            // Proses upload foto profil
            $fotoPath = null;
            if ($request->hasFile('image')) {
                $foto = $request->file('image');
                $namaFoto = Str::slug($request->name) . '-' . uniqid() . '.' . $foto->getClientOriginalExtension();
                $fotoPath = $foto->storeAs('public/foto_profil', $namaFoto);
                $fotoPath = str_replace('public/', 'storage/', $fotoPath);
            }

            User::create([
                'image' => $fotoPath,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role
            ]);

            return redirect('/user')->with('sukses', 'Data Berhasil Ditambahkan🥳');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return back()->with('gagal', "Data Gagal Ditambahkan😵, {$message}");
        }
    }

    public function edituser($id)
    {
        $user = User::find($id);
        $roles = ['admin' => 'Admin', 'guru' => 'Guru', 'orang_tua' => 'Orang Tua'];

        if (!$user) {
            return back()->with('gagal', 'Data Tidak Ditemukan😵');
        }

        return view('manajemen-user.edit-user', ['hideNavbar' => true], compact('user', 'roles'));
    }

    public function updateuser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'nullable|min:6'
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;

            // Proses update foto profil
            if ($request->hasFile('image')) {
                // Hapus foto lama jika ada
                if ($user->image && File::exists(public_path($user->image))) {
                    File::delete(public_path($user->image));
                }

                $foto = $request->file('image');
                $namaFoto = Str::slug($request->name) . '-' . uniqid() . '.' . $foto->getClientOriginalExtension();
                $fotoPath = $foto->storeAs('public/foto_profil', $namaFoto);
                $user->image = str_replace('public/', 'storage/', $fotoPath);
            }

            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return redirect('/user')->with('sukses', 'Data Berhasil Diedit🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Diedit😵 ' . $e->getMessage());
        }
    }

    public function deleteuser($id)
    {
        try {
            $user = User::findOrFail($id);

            // Hapus foto profil jika ada
            if ($user->image && File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $user->delete();

            return back()->with('sukses', 'Data Berhasil Dihapus🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dihapus😵');
        }
    }
}
