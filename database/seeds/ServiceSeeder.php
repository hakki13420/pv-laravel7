<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::truncate();
        Service::create([
            'id'            => 1,
            'service'       => 'المفتشية الاقليمية للتجارة بدائرة الغزوات',
            'adresse'       => 'شارع سايح الميسوم 245 الغزوات',
            'contact'       => '999999999',
            'created_by'    => 'admin',
        ]);
        Service::create([
            'id'            => 2,
            'service'       => 'المفتشية الاقليمية للتجارة بدائرة مغنية',
            'adresse'       => 'الحي الاداري الجديد 56 مغنية',
            'contact'       => '888888888',
            'created_by'    => 'admin',
        ]);
    }
}
