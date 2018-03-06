<?php

use App\User;
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
        User::create([
        	'id' => 1,
        	'name' => 'UGM Proceeding',
        	'email' => 'ugm.proceeding@mail.com',
        	'is_superadmin' => 1,
            'institution_id' => 1,
        	'password' => bcrypt('ugm.proceeding'),
        ]);
    }
}
