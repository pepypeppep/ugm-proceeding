<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create(['name' => 'Forestry']);
        Subject::create(['name' => 'Plant Breeding']);
        Subject::create(['name' => 'Information Technology']);
        Subject::create(['name' => 'Microbiology']);
        Subject::create(['name' => 'Gastronomy']);
        Subject::create(['name' => 'Organic Chemistry']);
        Subject::create(['name' => 'Computer']);
    }
}
