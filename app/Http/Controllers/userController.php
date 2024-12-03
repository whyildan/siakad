<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class userController extends Controller
{
    public function datauser()
    {
        try{
            $users = User::all();

            return view('manajemen-user.user', compact('users'));
        }catch(\Exception $e){
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
        try{
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required|in:admin,guru,orang_tua'
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role
            ]);

            return redirect('/user')->with('sukses', 'Data Berhasil Ditambahkan🥳');
        }catch(\Exception $e){
            $message = $e->getMessage();
            return back()->with('gagal', "Data Gagal Ditambahkan😵, {$message}");
        }
    }

    public function edituser($id)
    {
        $user = User::find($id);
        $roles = ['admin' => 'Admin', 'guru' => 'Guru', 'orang_tua' => 'Orang Tua'];

        if(!$user) {
            return back()->with('gagal', 'Data Tidak Ditemukan😵');
        }

        return view('manajemen-user.edit-user', ['hideNavbar' => true], compact('user', 'roles'));
    }

    public function updateuser(Request $request, $id)
    {
        try{
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'nullable|min:6'
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;

            if($request->filled('password')){
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return redirect('/user')->with('sukses', 'Data Berhasil Diedit🥳');
        }catch(\Exception $e){
            return back()->with('gagal', 'Data Gagal Diedit😵');
        }
    }

    public function deleteuser($id)
    {
        try{
            User::findOrFail($id);
            User::destroy($id);

            return back()->with('sukses', 'Data Berhasil Dihapus🥳');
        }catch(\Exception $e){
            return back()->with('gagal', 'Data Gagal Dihapus😵');
        }
    }

}
