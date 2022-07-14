<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ExerciceSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(BrigadeSeeder::class);
        $this->call(ConfigurationSeeder::class);
        $this->call(ModelRedactionSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(UserSeeder::class);
        //$this->call(CommuneSeeder::class);
        $this->call(ActiviteSeeder::class);
        $this->call(CommercantSeeder::class);
        $this->call(InfractionSeeder::class);
        $this->call(adresseComSeeder::class);
        //$this->call(activiteComSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(TypesaisieSeeder::class);


    }
}
