<?php

use App\Activite;
use Illuminate\Database\Seeder;

class ActiviteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activite::truncate();
        Activite::create([
            'code'=>'100001',
            'libelle'=>'production laitiers',
            'libelle_fr'=>'production laitiers',
            'created_by'=>'Admin',
        ]);
        Activite::create([
            'code'=>'501001',
            'libelle'=>'alimentation generales',
            'libelle_fr'=>'alimentation generales',
            'created_by'=>'Admin',
        ]);
        Activite::create([
            'code'=>'402103',
            'libelle'=>'import fruits',
            'libelle_fr'=>'import fruits',
            'created_by'=>'Admin',
        ]);

    }
}
