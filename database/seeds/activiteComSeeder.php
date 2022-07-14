<?php

use App\Activite_com;
use Illuminate\Database\Seeder;

class activiteComSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activite_com::truncate();
        Activite_com::create([
            'id'=>1,
            'activite_id'=>1,
            'libelle'=>' ',
            'commercant_id'=>1,
            'created_by'=>"admin",
        ]);
        Activite_com::create([
            'id'=>2,
            'activite_id'=>2,
            'libelle'=>' ',
            'commercant_id'=>1,
            'created_by'=>"admin",
        ]);
    }
}
