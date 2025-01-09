<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Student;
use App\Models\User;

class studentController extends Controller
{
    public function datasiswa()
    {
        try {
            $siswas = Student::with('class', 'user')->get();
            return view('student.index', compact('siswas'));
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return back()->with('gagal', "Data Gagal Dimuat😵, {$message}");
        }
    }

    public function tambahsiswa()
    {
        try {
            $kelas = Classes::all();

            return view('student.add', ['hideNavbar' => true], compact('kelas'));
        } catch (\Exception $e) {
            return back()->with('gagal', 'Form Gagal Dimuat😵');
        }
    }

    public function createstudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'student_identification_number' => 'required|string|max:16|unique:students,student_identification_number',
            'class_id' => 'required|exists:classes,id',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string|max:13|regex:/^[0-9]+$/',
            'address' => 'required|string',
            'parent_name' => 'required|string',
            'parent_email' => 'required|email|unique:users,email',
            'parent_password' => 'required|min:6',
        ]);

        try {
            // Simpan data user (orang tua) dengan role "orang_tua"
            $orangTua = User::create([
                'name' => $request->parent_name,
                'email' => $request->parent_email,
                'password' => bcrypt($request->parent_password),
                'role' => 'parent', // Tambahkan role langsung
            ]);

            // Simpan data siswa
            Student::create([
                'name' => $request->name,
                'student_identification_number' => $request->student_identification_number,
                'class_id' => $request->class_id,
                'date_of_birth' => $request->date_of_birth,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'parent_id' => $orangTua->id,
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
            $siswa = Student::with('user')->findOrFail($id);
            $kelas = Classes::all();
            return view('student.update', ['hideNavbar' => true], compact('siswa', 'kelas'));
        } catch (\Exception $e) {
            return back()->with('gagal', "Data Tidak Ditemukan😵");
        }
    }

    public function updatestudent(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'student_identification_number' => 'required|string|max:16|unique:students,student_identification_number',
            'class_id' => 'required|exists:classes,id',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string|max:13|regex:/^[0-9]+$/',
            'address' => 'required|string',
            'parent_name' => 'required|string',
            'parent_email' => 'required|email|unique:users,email',
            'parent_password' => 'nullable|min:6',
        ]);

        try {
            $siswa = Student::findOrFail($id);

            $siswa->update([
                'name' => $request->name,
                'student_identification_number' => $request->student_identification_number,
                'class_id' => $request->class_id,
                'date_of_birth' => $request->date_of_birth,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);

            // Update data orang tua
            $userData = [
                'name' => $request->parent_name,
                'email' => $request->parent_email,
            ];

            if ($request->filled('password')) {
                $userData['password'] = bcrypt($request->parent_password);
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
            $siswa = Student::findOrFail($id);

            $siswa->user->delete();

            $siswa->delete();

            return back()->with('sukses', 'Data Berhasil Dihapus🥳');
        } catch (\Exception $e) {
            return back()->with('gagal', 'Data Gagal Dihapus😵');
        }
    }
}
