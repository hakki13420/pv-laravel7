<?php

use App\Brigade;
use Illuminate\Database\Seeder;

class BrigadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brigade::truncate();
        Brigade::create([
            'id'                =>  1,
            'libelle'           =>  "الفرقة 01",
            'code'              =>  "B01",
            'service_id'        =>  1,
            'created_by'        =>  "Admin",
        ]);
        Brigade::create([
            'id'                =>  2,
            'libelle'           =>  "الفرقة 02",
            'code'              =>  "B02",
            'service_id'        =>  1,
            'created_by'        =>  "Admin",
        ]);
        Brigade::create([
            'id'                =>  3,
            'libelle'           =>  "الفرقة 03",
            'code'              =>  "B03",
            'service_id'        =>  1,
            'created_by'        =>  "Admin",
        ]);
        Brigade::create([
            'id'                =>  4,
            'libelle'           =>  "الفرقة 01",
            'code'              =>  "B01",
            'service_id'        =>  2,
            'created_by'        =>  "Admin",
        ]);
        Brigade::create([
            'id'                =>  5,
            'libelle'           =>  "الفرقة 02",
            'code'              =>  "B02",
            'service_id'        =>  2,
            'created_by'        =>  "Admin",
        ]);
    }
}
