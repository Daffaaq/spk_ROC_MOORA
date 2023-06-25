<?php

namespace App\Helpers;

use App\Criteria;
use App\Value;
use Illuminate\Support\Facades\DB;

class Helper
{
    public static function criteriaMenu()
    {
        $criterias = Criteria::all();
        return $criterias;
    }

    // public static function getCriteria()
    // {
    //     $getCriteria = DB::table('criterias')->get();
    //     $arrayCriteria = json_decode(json_encode($getCriteria), true);
    //     $criteria = array();

    //     foreach ($arrayCriteria as $row) {
    //         $criteria[$row['id']] = array($row['nama'], $row['tipe'], $row['bobot']);
    //     }

    //     return $criteria;
    // }
    public static function getCriteria()
    {
        $getCriteria = DB::table('criterias')->get();
        $arrayCriteria = json_decode(json_encode($getCriteria), true);
        $criteria = array();

        foreach ($arrayCriteria as $row) {
            $criteria[$row['id']] = [
                'nama' => $row['nama'],
                'tipe' => $row['tipe'],
                'bobot' => $row['bobot']
            ];;
        }

        return $criteria;
    }

    public static function getAlternative()
    {
        $getAlternatives = DB::table('alternatives')->select('id', 'nama')->get();
        $arrayAlternative = json_decode(json_encode($getAlternatives), true);
        $alternatives = array();

        $index = 1;
        foreach ($arrayAlternative as $alternative) {
            $alternatives[$index] = $alternative['nama'];
            $index++;
        }

        return $alternatives;
        // $getAlternatives = DB::table('alternatives')->select('id', 'nama')->get();
        // $arrayAlternative = json_decode(json_encode($getAlternatives), true);
        // $alternative = array();

        // foreach ($arrayAlternative as $alternative) {
        //     $alternatives[$alternative['id']] = $alternative['nama'];
        // }

        // return $alternatives;
    }


    public static function valMatrix()
    {
        $result = Value::all();
        $valMatrix = array();

        foreach ($result as $score) {
            $alternative = $score->alternative_id;
            $criteria = $score->criteria_id;
            $val = $score->value;

            $valMatrix[$alternative][$criteria] = $val;
        }

        return $valMatrix;
    }

    // public static function valNormal()
    // {
    //     $criteria = Helper::getCriteria();
    //     $alternatives = Helper::getAlternative();
    //     $matrix = Helper::getMatrix();

    //     $normal = $matrix;
    //     foreach ($criteria as $criteria_id => $c) {
    //         // Menghitung nilai pembagi sesuai rumus
    //         $divider = 0;
    //         foreach ($alternatives as $alternative_id => $a) {
    //             $divider += pow($matrix[$alternative_id][$criteria_id], 2);
    //         }
    //         $divider = sqrt($divider);

    //         // Normalisasi nilai berdasarkan rumus
    //         foreach ($alternatives as $alternative_id => $a) {  
    //             $normal[$alternative_id][$criteria_id] /= $divider;
    //         }
    //     }
    //     // dd($normal);
    //     return $normal;
    // }

    public static function valNormal()
    {
        $criteria = Helper::getCriteria();
        $alternatives = Helper::getAlternative();
        $matrix = Helper::valMatrix();

        $normal = $matrix;
        foreach ($criteria as $criteria_id => $c) {
            // Menghitung nilai pembagi sesuai rumus
            $divider = 0;
            foreach ($alternatives as $alternative_id => $alternative) {
                $divider += pow($matrix[$alternative_id][$criteria_id], 2);
            }
            $divider = sqrt($divider);

            // Normalisasi nilai berdasarkan rumus
            foreach ($alternatives as $alternative_id => $alternative) {
                // $index = $alternative_id;
                // if (!isset($normal[$index][$criteria_id])) {
                //     dd($normal, $index, $criteria_id);
                // }
                // $normal[$index][$criteria_id] /= $divider;
                $normal[$alternative_id][$criteria_id] /= $divider;
            }
        }
        return $normal;
    }















    // public static function valOptimize()
    // {
    //     $criteria = Helper::getCriteria();
    //     $alternatives = Helper::getAlternative();
    //     $normal = Helper::valNormal();

    //     $optimization = [];
    //     foreach ($alternatives as $alternative_id => $alternative) {
    //         $optimization[$alternative_id] = 0;
    //         foreach ($criteria as $criteria_id => $c) {
    //             $weight = $criteria[$criteria_id]['bobot'];
    //             $optimization[$alternative_id] += $normal[$alternative_id][$criteria_id] * ($c['tipe'] == 'benefit' ? $weight : -$weight);
    //         }
    //     }

    //     return $optimization;
    // }
    public static function valOptimize()
    {
        // $criteria = Helper::getCriteria();
        // $alternative = Helper::getAlternative();
        // $normal = Helper::valNormal();

        // $optimization = array();
        // foreach ($alternative as $alternative_id => $a) {
        //     $optimization[$alternative_id] = 0;
        //     foreach ($criteria as $criteria_id => $c) {
        //         $optimization[$alternative_id] += $normal[$alternative_id][$criteria_id] * ($c[1] == 'benefit' ? 1 : -1) * $c[2];
        //     }
        // }
        $criteria = Helper::getCriteria();
        $alternatives = Helper::getAlternative();
        $normal = Helper::valNormal();

        $optimization = $normal;
        foreach ($alternatives as $alternative_id => $alternative) {
            foreach ($criteria as $criteria_id => $c) {
                $factor = ($c['tipe'] == 'cost') ? 1 : 1; // Menggunakan faktor 1 untuk semua kriteria
                $optimization[$alternative_id][$criteria_id] = $normal[$alternative_id][$criteria_id] * $factor * $c['bobot'];
                // $optimization[$alternative_id][$criteria_id] *= ($c['tipe'] == 'benefit' ? 1 : -1) * $c['bobot'];
            }
        }

        // dd($optimization);

        return $optimization;
        // }
        // public static function valOptimize()
        // {
        //     $criteria = Helper::getCriteria();
        //     $alternatives = Helper::getAlternative();
        //     $normal = Helper::valNormal();

        //     $optimization = $normal;
        //     foreach ($alternatives as $alternative_id => $alternative) {
        //         $optimization[$alternative_id] = 0;
        //         $totalWeight = 0;
        //         foreach ($criteria as $criteria_id => $c) {
        //             $optimization[$alternative_id] += $normal[$alternative_id][$criteria_id] * $c['bobot'];
        //             // dd($optimization);
        //             // $optimization[$alternative_id] += $normal[$alternative_id][$criteria_id] * ($c['tipe'] == 'benefit' ? 1 : -1) * $c['bobot'];
        //             $totalWeight += $c['bobot'];
        //         }
        //         $optimization[$alternative_id] /= $totalWeight;
        //     }
        // foreach ($criteria as $criteria_id => $c) {
        //     $optimization[$criteria_id] = 0;
        //     foreach ($alternatives as $alternative_id => $alternative) {
        //         $optimization[$criteria_id] += $normal[$alternative_id][$criteria_id] * $c['bobot'];
        //     }
        // }


        // return $optimization;
    }

    // public static function ranking()
    // {
    //     $criteria = Helper::getCriteria();
    //     $alternatives = Helper::getAlternative();
    //     $optimization = Helper::valOptimize();

    //     $rankedData = array();

    //     foreach ($alternatives as $alternative_id => $alternative) {
    //         $benefitTotal = 0;
    //         $costTotal = 0;

    //         foreach ($criteria as $criteria_id => $c) {
    //             if ($c['tipe'] == 'benefit') {
    //                 $benefitTotal += $optimization[$alternative_id][$criteria_id];
    //             } elseif ($c['tipe'] == 'cost') {
    //                 $costTotal += $optimization[$alternative_id][$criteria_id];
    //             }
    //         }

    //         $benefitMinusCost = $benefitTotal - $costTotal;

    //         $rankedData[$alternative_id] = [
    //             'benefitTotal' => $benefitTotal,
    //             'costTotal' => $costTotal,
    //             'benefitMinusCost' => $benefitMinusCost,
    //         ];
    //     }

    //     // Sorting rankedData based on benefitMinusCost in descending order
    //     arsort($rankedData);

    //     return $rankedData;
    // }

    public static function ranking()
    {
        $criteria = Helper::getCriteria();
        $alternatives = Helper::getAlternative();
        $optimization = Helper::valOptimize();

        $rankingData = array();

        foreach ($alternatives as $alternative_id => $alternative) {
            $benefitTotal = 0;
            $costTotal = 0;

            foreach ($criteria as $criteria_id => $c) {
                if ($c['tipe'] == 'benefit') {
                    $benefitTotal += $optimization[$alternative_id][$criteria_id];
                } elseif ($c['tipe'] == 'cost') {
                    $costTotal += $optimization[$alternative_id][$criteria_id];
                }
            }

            $benefitMinusCost = $benefitTotal - $costTotal;

            $rankingData[] = [
                'alternative_id' => $alternative_id,
                'benefitTotal' => $benefitTotal,
                'costTotal' => $costTotal,
                'benefitMinusCost' => $benefitMinusCost,
            ];
        }

        return $rankingData;
    }


    public static function rankingadmin()
    {
        $criteria = Helper::getCriteria();
        $alternatives = Helper::getAlternative();
        $optimization = Helper::valOptimize();

        $rangkeddataadmin = array();

        foreach ($alternatives as $alternative_id => $alternative) {
            $benefitTotal = 0;
            $costTotal = 0;

            foreach ($criteria as $criteria_id => $c) {
                if ($c['tipe'] == 'benefit') {
                    $benefitTotal += $optimization[$alternative_id][$criteria_id];
                } elseif ($c['tipe'] == 'cost') {
                    $costTotal += $optimization[$alternative_id][$criteria_id];
                }
            }

            $benefitMinusCost = $benefitTotal - $costTotal;

            $rangkeddataadmin[$alternative_id] = [
                'benefitTotal' => $benefitTotal,
                'costTotal' => $costTotal,
                'benefitMinusCost' => $benefitMinusCost,
            ];
        }

        // Sorting rangkeddataadmin based on benefitMinusCost in descending order
        arsort($rangkeddataadmin);

        return $rangkeddataadmin;
    }
}
