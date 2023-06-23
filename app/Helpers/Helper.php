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
        $alternatives = array();

        foreach ($getAlternatives as $alternative) {
            $alternatives[$alternative->id] = $alternative->nama;
        }

        return $alternatives;
    }

    public static function getMatrix()
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

    // public static function calculateMooraNormalization()
    // {
    //     $criteria = Helper::getCriteria();
    //     $alternatives = Helper::getAlternative();
    //     $matrix = Helper::getMatrix();

    //     $normalizedMatrix = $matrix;
    //     foreach ($criteria as $criteria_id => $c) {
    //         // Menghitung nilai minimum dan maksimum untuk kriteria
    //         $minValue = min(array_column($matrix, $criteria_id));
    //         $maxValue = max(array_column($matrix, $criteria_id));

    //         // Normalisasi nilai berdasarkan rumus
    //         foreach ($alternatives as $alternative_id => $a) {
    //             $normalizedMatrix[$alternative_id][$criteria_id] = ($matrix[$alternative_id][$criteria_id] - $minValue) / ($maxValue - $minValue);
    //         }
    //     }

    //     return $normalizedMatrix;
    // }

    public static function valNormal()
    {
        $criteria = Helper::getCriteria();
        $alternatives = Helper::getAlternative();
        $matrix = Helper::getMatrix();

        $normal = $matrix;
        foreach ($criteria as $criteria_id => $c) {
            // Menghitung nilai pembagi sesuai rumus
            $divider = 0;
            foreach ($alternatives as $alternative_id => $a) {
                $divider += pow($matrix[$alternative_id][$criteria_id], 2);
            }
            $divider = sqrt($divider);

            // Normalisasi nilai berdasarkan rumus
            foreach ($alternatives as $alternative_id => $a) {
                $normal[$alternative_id][$criteria_id] /= $divider;
            }
        }

        return $normal;
    }

    public static function valOptimize()
    {
        $criteria = Helper::getCriteria();
        $alternatives = Helper::getAlternative();
        $normal = Helper::valNormal();

        $optimization = [];
        foreach ($alternatives as $alternative_id => $alternative) {
            $optimization[$alternative_id] = 0;
            foreach ($criteria as $criteria_id => $c) {
                $weight = $criteria[$criteria_id]['bobot'];
                $optimization[$alternative_id] += $normal[$alternative_id][$criteria_id] * ($c['tipe'] == 'benefit' ? $weight : -$weight);
            }
        }

        return $optimization;
    }
}
