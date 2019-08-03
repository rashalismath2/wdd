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
        $this->call(OperatorTableSeeder::class);    
        $this->call(LecturersTableSeeder::class);    
    }
}
