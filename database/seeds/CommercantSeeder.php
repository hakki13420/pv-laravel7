<?php

use Illuminate\Database\Seeder;
use App\Commercant;

class CommercantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Commercant::truncate();
        Commercant::create([
            'nrc'  => '11B000055',
            'name'  => 'بوزيد عمور',
            'rais_soc'  => '/',
            'date_n'  => date('Y-m-d',strtotime('01/07/1995')),
            'lieux_n'  => 1,
            'adresse_d'  => 'حي الرملة 45 الغزوات',
            'commune_id'  => 1,
            'tel'  => '5555555',
            'pere'  => 'ميلود',
            'mere'  => 'سماتي جميلة',
            'created_by'  => 'admin',
        ]);
    }
}
