<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use File;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* 1. Metode $mahasiswas */
        /*                       */
        // $mahasiswas = Mahasiswa::all();
        // return response()->json([
        //     $mahasiswas
        // ], 200);


        /* 2. Metode 'mahasiswa' => $mahasiswa */
        /*                                     */
        $mahasiswas = Mahasiswa::all();
        return response()->json([
            'mahasiswas' => $mahasiswas
        ], 200);


        /* 3. Metode    'pesan' => true,             */
        /*               'dosen wali' => 'Prayitno'  */
        /*               'mahasiswas' => $mahasiswas */
        /*                                           */
        // $mahasiswas = Mahasiswa::all();
        // return response()->json([
        //     'pesan' => true,
        //     'dosen wali' => 'Prayitno',
        //     'mahasiswas' => $mahasiswas
        // ], 200);
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mahasiswa = new Mahasiswa;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->email = $request->email;

        //untuk upload foto
        if ($request->hasFile('foto')) {
            // nama file
            $foto = time().'.'.$request->foto->getClientOriginalExtension();
            // pindah file
            $request->foto->move(public_path('foto'), $foto);
            // simpan file
            $mahasiswa->foto = $foto;
        } else {
            $mahasiswa->foto = '';
        }
        // $mahasiswa->foto = $request->foto;
        $mahasiswa->save();

        return response()->json([
            'pesan' => 'Data Berhasil Disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Menampilkan detail mahasiswa
        $mahasiswa = Mahasiswa::find($id);

        return response()->json([
            'mahasiswa' => $mahasiswa
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->nama = $request->nama;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->email = $request->email;
        // jika klik tombol upload
        if ($request->hasFile('foto')) {
            // ganti foto
            // 1. hapus foto
            if (File::exists('foto/'.$mahasiswa->foto)) {
                File::delete('foto/'.$mahasiswa->foto);
            }
            // 2. Upload file
            // nama file
            $foto = time().'.'.$request->foto->getClientOriginalExtension();
            // pindah file
            $request->foto->move(public_path('foto'), $foto);
            // simpan file
            $mahasiswa->foto = $foto;
        }
        $mahasiswa->save();

        return response()->json([
            'pesan' => 'Data Berhasil Diupdate'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // menghapus data mahasiswa
        $mahasiswa = Mahasiswa::find($id);
        if (File::exists('foto/'.$mahasiswa->foto)) {
            File::delete('foto/'.$mahasiswa->foto);
        }
		$mahasiswa->delete();

		return response()->json([
			'pesan' => 'Berhasil dihapus'
		], 200);
    }
}
