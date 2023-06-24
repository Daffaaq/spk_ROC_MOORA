<?php

namespace App\Imports;

use App\Alternative;
use App\Models\UraianJenisPerusahaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class KriteriaAlternatifImports implements ToModel, WithHeadingRow, WithUpserts

{
    public function model(array $row)
    {
        return new Alternative([
            'nama_uraian_jenis_perusahaan' => $row['nama_uraian_jenis_perusahaan'],
        ]);
    }

    public function uniqueBy()
    {
        return 'nama_uraian_jenis_perusahaan';
    }
}
