<?php

use App\Exercice;
use Illuminate\Database\Seeder;

class ExerciceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exercice::truncate();
        Exercice::create([
            "id"      =>1,
            "year"      =>2021,
            "libelle"   =>"ألفين و واحد و عشرين",
            "created_by"   =>"admin",
        ]);
        Exercice::create([
            "id"      =>2,
            "year"      =>2022,
            "libelle"   =>"ألفين و إثنان و عشرين",
            "created_by"   =>"admin",
        ]);
    }
}
