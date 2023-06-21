<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use Illuminate\Queue\Jobs\RedisJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = $this->hitungBobot();
        $kriteria = $kriteria->sortBy('id');
    
        return view('layouts.kriteria', ['kriteria' => $kriteria]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
 public function hitungBobot()
    {
        // Skala prioritas kriteria
        $prioritas = [           
            'harga' => 4,
            'kualitas' => 3,
            'pelayanan' => 6,
            'lokasi' => 8,
            'wifi' => 5,
            'suasana' => 1,
            'kenyamanan' => 2,
            'kebersihan' => 7,
            'menu_unik' => 9,
            'respon_pelanggan' => 10,
            // Tambahkan kriteria lain sesuai kebutuhan
        ];

        // Perangkingan kriteria berdasarkan skala prioritas
        $perangkingan = collect($prioritas)->sortDesc()->values();

        // Hitung total peringkat
        $totalPeringkat = $perangkingan->sum();

        // Tentukan bobot relatif untuk setiap kriteria
        $kriteria = Kriteria::all();
        foreach ($kriteria as $item) {
            $peringkat = $perangkingan->search($prioritas[$item->nama_kriteria]) + 1;
            $item->bobot_rel = $peringkat / $totalPeringkat;
        }

        return $kriteria;
    }
}
