<?php

use App\Commune;
use Illuminate\Database\Seeder;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Commune::truncate();

        Commune::create([
            'commune'=>'souahlia',
            'daira'=>'ghazaouet',
            'wilaya'=>'tlemcen',
            'created_by'=>'hakki',
        ]);

        Commune::create([
            'commune'=>'tiant',
            'daira'=>'ghazaouet',
            'wilaya'=>'tlemcen',
            'created_by'=>'hakki',
        ]);
        Commune::create([
            'commune'=>'maghnia',
            'daira'=>'maghnia',
            'wilaya'=>'tlemcen',
            'created_by'=>'hakki',
        ]);
    }
}
