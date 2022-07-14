<?php

use App\Adresse_com;
use Illuminate\Database\Seeder;

class adresseComSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adresse_com::truncate();
        Adresse_com::create([
            'id'=>1,
            'adresse_com'=>"al haout souahlia Tlemcen",
            'commercant_id'=>1,
            'created_by'=>"admin",
        ]);
        Adresse_com::create([
            'id'=>2,
            'adresse_com'=>"zawiat mira souahlia Tlemcen",
            'commercant_id'=>1,
            'created_by'=>"admin",
        ]);
        Adresse_com::create([
            'id'=>3,
            'adresse_com'=>"beghaouen souahlia Tlemcen",
            'commercant_id'=>1,
            'created_by'=>"admin",
        ]);
    }
}
