<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    protected $table = 'alternatives';
    protected $fillable = [
        'nama',
        'kode',
        'Teletubise',
        'Masha and the Bear',
        'Laptop Si Unyil',
        'The Boss Baby',
        'Burung Opila',
        'Jombos',
        'Upin & Ipin',
        'Miky Mouse',
        'Doraemon',
        'Spongebob Squarepants',
        'Lagu Dangdut',
        'Cocomelon',
        'Casper',
        'Tayo',
        'PORORO',
        'Nusa Rara',
        'Tom & Jerry',
        'Shincan',
        'Adit dan Sopo Jarwo',
        'Dora'
    ];

    public function value()
    {
        return $this->hasmany(Value::class);
    }

    public function criteria()
    {
        return $this->hasOne(Criteria::class);
    }
}
