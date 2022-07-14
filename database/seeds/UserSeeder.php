<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name'=>'حكي رابح',
            'email'=>'hakki@me.com',
            'password'=>Hash::make('12345678'),
            'role'=>'Admin',
            'grade_id'=>1,
            'carte_com'=>'1234P',
            'date_carte_com'=> date('Y-m-d',strtotime('01/07/1995')),
            'service_id'=>1,
            'created_by'=>'Admin',
        ]);
        User::create([
            'name'=>'سونة ميمون',
            'email'=>'souna@me.com',
            'password'=>Hash::make('12345678'),
            'role'=>'Agent',
            'grade_id'=>1,
            'carte_com'=>'7894P',
            'date_carte_com'=> date('Y-m-d',strtotime('01/11/1975')),
            'service_id'=>1,
            'brigade_id'=>1,
            'created_by'=>'Admin',
        ]);
        User::create([
            'name'=>'ميم محمد',
            'email'=>'mime@me.com',
            'password'=>Hash::make('12345678'),
            'role'=>'Agent',
            'grade_id'=>1,
            'carte_com'=>'7894P',
            'date_carte_com'=> date('Y-m-d',strtotime('01/11/1975')),
            'service_id'=>1,
            'brigade_id'=>1,
            'created_by'=>'Admin',
        ]);
        User::create([
            'name'=>'عزيز عواطف',
            'email'=>'aziz@me.com',
            'password'=>Hash::make('12345678'),
            'role'=>'Agent',
            'grade_id'=>1,
            'carte_com'=>'7894P',
            'date_carte_com'=> date('Y-m-d',strtotime('01/11/1975')),
            'service_id'=>1,
            'brigade_id'=>2,
            'created_by'=>'Admin',
        ]);
        User::create([
            'name'=>'عصماني عبد الوهاب',
            'email'=>'otmani@me.com',
            'password'=>Hash::make('12345678'),
            'role'=>'Agent',
            'grade_id'=>1,
            'carte_com'=>'7894P',
            'date_carte_com'=> date('Y-m-d',strtotime('01/11/1975')),
            'service_id'=>1,
            'brigade_id'=>2,
            'created_by'=>'Admin',
        ]);
        User::create([
            'name'=>'حبيبس زوبير',
            'email'=>'habibes@me.com',
            'password'=>Hash::make('12345678'),
            'role'=>'Chef',
            'grade_id'=>1,
            'carte_com'=>'7894P',
            'date_carte_com'=> date('Y-m-d',strtotime('01/11/1975')),
            'service_id'=>1,
            'created_by'=>'Admin',
        ]);

        User::create([
            'name'=>'ميدون أمين',
            'email'=>'midoune@me.com',
            'password'=>Hash::make('12345678'),
            'role'=>'Agent',
            'grade_id'=>1,
            'carte_com'=>'7894P',
            'date_carte_com'=> date('Y-m-d',strtotime('01/11/1975')),
            'service_id'=>2,
            'brigade_id'=>1,
            'created_by'=>'Admin',
        ]);
        User::create([
            'name'=>'بن جامعي عبد القادر',
            'email'=>'benjamai@me.com',
            'password'=>Hash::make('12345678'),
            'role'=>'Agent',
            'grade_id'=>1,
            'carte_com'=>'7894P',
            'date_carte_com'=> date('Y-m-d',strtotime('01/11/1975')),
            'service_id'=>2,
            'brigade_id'=>1,
            'created_by'=>'Admin',
        ]);
        User::create([
            'name'=>'ميلود ابراهيم',
            'email'=>'miloud@me.com',
            'password'=>Hash::make('12345678'),
            'role'=>'Chef',
            'grade_id'=>1,
            'carte_com'=>'7894P',
            'date_carte_com'=> date('Y-m-d',strtotime('01/11/1975')),
            'service_id'=>2,
            'created_by'=>'Admin',
        ]);
    }
}
