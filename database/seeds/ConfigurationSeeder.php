<?php

use App\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::truncate();
        Configuration::create([
            'ministere'         =>'وزارة التجارة',
            'organisme'         =>'مديرية التجارة لولاية تلمسان',
            'slogan'         =>'DCW.Tlemcen',
            'adresse'         =>'09 حي النسيم إمامة تلمسان',
            'email'         =>'dcptlemcen@gmail.com',
            'site'         =>'www.dcwtlemcen.dz',
            'tel'         =>'043 21 08 74 - 043 21 08 76',
            'fax'         =>'043 21 08 79',
            'created_by'         =>'admin',
        ]);
    }
}
