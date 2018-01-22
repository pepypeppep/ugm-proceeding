<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'id' => 1,
        	'name' => 'UGM Proceeding',
        	'email' => 'ugm.proceeding@mail.com',
        	'is_superadmin' => 1,
            'institution_id' => 1,
        	'password' => bcrypt('w1lldone'),
        	'created_at' => \Carbon\Carbon::now(),
        	'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
