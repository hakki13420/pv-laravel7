<?php

use App\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::truncate();
        Grade::create([
            'id'=> 1,
            'grade'=>'محقق للمنافسة',
            'created_by'=>'admin',
        ]);
        Grade::create([
            'id'=> 2,
            'grade'=>'محقق رئيسي للمنافسة',
            'created_by'=>'admin',
        ]);
        Grade::create([
            'id'=> 3,
            'grade'=>'رئيس محقق رئيسي للمنافسة',
            'created_by'=>'admin',
        ]);
        Grade::create([
            'id'=> 4,
            'grade'=>'مفتش رئيسي للمنافسة',
            'created_by'=>'admin',
        ]);
        Grade::create([
            'id'=> 5,
            'grade'=>'رئيس مفتش رئيسي للمنافسة',
            'created_by'=>'admin',
        ]);
        Grade::create([
            'id'=> 6,
            'grade'=>'مفتش قسم للمنافسة',
            'created_by'=>'admin',
        ]);
    }
}
