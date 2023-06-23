<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;

class MooraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function matrix()
    {
        $matrix = Helper::getMatrix();

        return view('moora.matrix', compact('matrix'));
    }

    public function normalization()
    {
        $normal = Helper::valNormal();
        $matrix = Helper::getMatrix();
        // return $normal;
        return view('moora.normalization', compact('normal', 'matrix'));
    }

    public function optimization()
    {
        $alternatives = Helper::getAlternative();
        $optimization = Helper::valOptimize();

        return view('moora.optimization', compact('optimization', 'alternatives'));
    }

    public function ranking()
    {
        $alternatives = Helper::getAlternative();
        $optimization = Helper::valOptimize();

        // Mengurutkan data secara descending dengan tetap mempertahankan key/index array-nya
        arsort($optimization);

        // Mendapatkan key/index item array yang pertama
        $index = key($optimization);

        $rank = 1;

        return view('moora.ranking', compact('optimization', 'alternatives', 'rank'));
    }
}
