<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('criterias')->insert([
            [
                'nama' => 'Bersifat Mendidik',
                'tipe' => 'benefit',
                'bobot' => 0.292896825,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Menghibur',
                'tipe' => 'benefit',
                'bobot' => 0.109563492,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Bersifat kreatif',
                'tipe' => 'benefit',
                'bobot' => 0.084563492,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Mengandung kekerasan',
                'tipe' => 'cost',
                'bobot' => 0.03361111,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Mengandung kata-kata kasar',
                'tipe' => 'cost',
                'bobot' => 0.01,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Mengandung unsur pornografi',
                'tipe' => 'cost',
                'bobot' => 0.021111111,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Kualitas tayangan',
                'tipe' => 'benefit',
                'bobot' => 0.192896825,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Ketersediaan opsi bahasa',
                'tipe' => 'cost',
                'bobot' => 0.047896825,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Durasi tayang',
                'tipe' => 'benefit',
                'bobot' => 0.064563492,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Menambah wawasan',
                'tipe' => 'benefit',
                'bobot' => 0.142896825,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
