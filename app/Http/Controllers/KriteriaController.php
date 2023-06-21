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
            'Bersifat Mendidik' => 1,
            'Mengibur' => 4, 
            'Bersifat Kreatif' => 5,
            'Mengandung Kekerasan' => 8,
            'Mengandung kata-kata kasar' => 10,
            'mengandung unsur pornografi' => 9,
            'kualitas tayangan' => 2,
            'ketersediaan opsi bahasa' => 7,
            'durasi tayang' => 6,
            'menambah wawasan' => 3,
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
