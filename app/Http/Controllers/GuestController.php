<?php

namespace App\Http\Controllers;

use App\{Alternative, Criteria, User, Value};
use App\Helpers\Helper;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function home()
    {
        $countAlternatives = Alternative::count();
        $countCriterias = Criteria::count();
        $countValues = Value::count();
        $countUsers = User::count();
        $criterias = Criteria::all();
        $alternatives = Alternative::all();
        $matrix = Helper::getMatrix();

        $alternative = Helper::getAlternative();
        $optimization = Helper::valOptimize();
        $rankingData = Helper::ranking();

        //--mengurutkan data secara descending dengan tetap mempertahankan key/index array-nya
        arsort($rankingData);
        //-- mendapatkan key/index item array yang pertama
        $index = key($rankingData);

        $rank = 1;

        return view ('home', compact('countAlternatives', 'countCriterias', 'countValues', 'countUsers', 'criterias', 'alternatives', 'matrix', 'optimization', 'alternative', 'rank', 'rankingData'));
    }
}
