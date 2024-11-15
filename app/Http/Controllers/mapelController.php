<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Exception;
use Illuminate\Http\Request;

class mapelController extends Controller
{
    public function datamapel()
    {
        return view('manajemen-mapel.mapel');
    }

    public function tambahmapel()
    {
        return view('manajemen-mapel.tambah-mapel', ['hideNavbar' => true]);
    }

    public function storesubject(Request $request)
    {
        try {
            Mapel::create([
                'nama_mapel' => $request->nama_mapel
            ]);

            return redirect('/subject');
        }catch(\Exception $e) {
            return redirect()->back();
        }
    }

    public function editmapel()
    {
        return view('manajemen-mapel.edit-mapel', ['hideNavbar' => true]);
    }
}
