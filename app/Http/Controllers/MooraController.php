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
    // public function normalization()
    // {
    //     $normalizedMatrix = Helper::mooraNormalization();
    //     $matrix = Helper::getMatrix();
    //     // return $normal;
    //     return view('moora.normalization', compact('normalizedMatrix', 'matrix'));
    // }

    public function optimization()
    {
        $criteria = Helper::getCriteria();
        $alternatives = Helper::getAlternative();
        $optimization = Helper::valOptimize();
        return view('moora.optimization', compact('optimization', 'alternatives', 'criteria'));
    }

    public function ranking()
    {
        $criteria = Helper::getCriteria();
        $alternatives = Helper::getAlternative();
        $optimization = Helper::valOptimize();
        $rankingData = Helper::ranking();

        return view('moora.ranking', compact('optimization', 'alternatives', 'criteria', 'rankingData'));
    }
}
