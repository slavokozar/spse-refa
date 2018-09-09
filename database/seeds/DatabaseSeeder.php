<?php

use App\Models\User;
use App\Models\Area;
use App\Models\Failure;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'System Admin',
            'email' => 'slavo.kozar@gmail.com',
            'password' => bcrypt('coloportus')
        ]);

        $user->superadmin = true;
        $user->save();

        $handle = fopen(storage_path('app/users.txt'), 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {

                $line = explode(",", $line);

                User::create([
                    'name' => $line[0],
                    'email' => $line[1],
                    'password' => $line[2]
                ]);
            }

            fclose($handle);
        } else {
            // error opening the file.
        }

        Area::create([
            'name' => 'Global',
            'pc' => 0
        ]);

        $areas = [
            'LIT1',
            'LIT2',
            'LIT3',
            'LIT4',
            'LIT5',
            'LIT6',
            'LIT7'
        ];

        foreach($areas as $area){
            Area::create([
                'name' => $area,
                'pc' => 10
            ]);
        }

        $failures = [
            'Problém s prihlásením do PC',
            'Nefunkčný Internet',
            'Problém so softvérom',
            'PC sa nedá zapnúť',
            'Nefunkčná myš',
            'Nefunkčná klávesnica',
            'Nefunkčný monitor',
            'Blue screen Windows',
            'Chýbajúci softvér',
        ];

        foreach($failures as $failure){
            Failure::create([
                'name' => $failure,
            ]);
        }

    }
}
