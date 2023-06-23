<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Aditdansopojarwo = [5, 5, 4, 5, 4, 1, 5, 5, 5, 4];
        $Dora = [5, 5, 4, 5, 5, 4, 5, 4, 3, 5];
        $Teletubise = [4, 4, 4, 4, 4, 5, 4, 4, 3, 5];
        $MashaandtheBear = [5, 5, 2, 4, 2, 5, 5, 3, 5, 5];
        $LaptopSiUnyil = [4, 5, 5, 5, 5, 4, 5, 5, 5, 5];
        $TheBossBaby = [5, 1, 3, 1, 3, 3, 5, 2, 4, 5];
        $Burungopila = [5, 5, 2, 5, 3, 4, 4, 3, 3, 4];
        $Jombos = [4, 5, 5, 5, 2, 3, 4, 5, 3, 4];
        $UpinIpin = [5, 2, 5, 1, 5, 5, 5, 1, 5, 5];
        $Mikymouse = [5, 5, 4, 4, 4, 4, 3, 4, 3, 4];
        $Doraemon = [5, 3, 5, 3, 3, 3, 5, 3, 3, 5];
        $SpongebobSquarepants = [5, 2, 3, 1, 1, 4, 3, 3, 3, 4];
        $LaguDangdut = [4, 3, 5, 3, 4, 3, 3, 5, 4, 4];
        $cocomelon = [5, 5, 5, 5, 3, 2, 4, 5, 4, 2];
        $Casper = [5, 5, 5, 4, 5, 5, 5, 5, 5, 5];
        $Tayo = [5, 5, 4, 4, 4, 4, 3, 4, 4, 5];
        $PORORO = [4, 5, 4, 4, 4, 3, 4, 4, 3, 4];
        $NusaRara = [4, 5, 4, 4, 4, 3, 5, 5, 4, 3];
        $TomJerry = [3, 5, 4, 4, 4, 4, 5, 3, 4, 4];
        $Shincan = [3, 3, 3, 3, 3, 4, 4, 2, 5, 3];
        $IELTSListening = [5, 4, 4, 5, 4, 5, 5, 5, 5, 5];
        $WargaNetLife = [4, 5, 5, 3, 4, 5, 5, 1, 5, 5];
        $WebareBears = [4, 5, 4, 4, 5, 5, 4, 5, 4, 4];

        $ratings = array(
            $Teletubise, $MashaandtheBear, $LaptopSiUnyil, $TheBossBaby, $Burungopila, $Jombos, $UpinIpin, $Mikymouse, $Doraemon, $SpongebobSquarepants, $LaguDangdut, $cocomelon, $Casper, $Tayo, $PORORO, $NusaRara, $TomJerry, $Shincan, $IELTSListening, $WargaNetLife, $WebareBears, $Aditdansopojarwo, $Dora
        );


        for ($i = 1; $i <= 23; $i++) {
            for ($j = 1; $j <= count($Dora); $j++) {

                DB::table('values')->insert([
                    [
                        'alternative_id' => $i,
                        'criteria_id' => $j,
                        'value' => $ratings[$i - 1][$j - 1],
                        'user_id' => 1,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ],
                ]);
            }
        }
    }
}
