<?php



use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Operator;
use App\Lecturer;
use App\Admin;
use App\Department;
use App\Batch;
use App\Resource;


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Operator::class, function(Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'), // password
        'contact_no' => $faker->phoneNumber,
    ];
});

$factory->define(Lecturer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'), // password
        'phone' => $faker->phoneNumber,
        'departments_id' => function(){
            return factory(Department::class)->create(['title'=>'testdepartment'])->id;
        },
    ];
});

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'), // password

    ];
});

$factory->define(Department::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
    ];
});

$factory->define(Department::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
    ];
});

$factory->define(Resource::class, function (Faker $faker) {
    return [
        'resource_type' => $faker->name,
        'floor_number' => 100,
        'room_no' => 100,
    ];
});

$factory->define(Batch::class, function (Faker $faker) {
    return [
        'student_count' => 10,
        'departments_id' => function(){
            return 
                Department::where('title','testdepartment')->first()->id
            ;
        },
        'batch_id'=>1
       
    ];
});






