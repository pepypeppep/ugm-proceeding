<?php

use App\Identifier;
use Illuminate\Database\Seeder;

class IdentifierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Identifier::create(['type' => 'online_isbn']);
        Identifier::create(['type' => 'print_isbn']);
        Identifier::create(['type' => 'online_issn']);
        Identifier::create(['type' => 'print_issn']);
        Identifier::create(['type' => 'doi']);
    }
}
