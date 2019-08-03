<?php

use Illuminate\Database\Seeder;

class LecturersTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Lecturer::class,50)->create();
    }
}
