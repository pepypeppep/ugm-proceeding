<?php

use Illuminate\Database\Seeder;

class DefaultInstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutions')->insert([
        	'id' => 1,
        	'name' => 'Badan Penerbit dan Publikasi',
        	'created_at' => \Carbon\Carbon::now(),
        	'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('institutions')->insert([
        	'id' => 2,
        	'name' => 'Fakultas Teknologi Pertanian',
        	'created_at' => \Carbon\Carbon::now(),
        	'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
