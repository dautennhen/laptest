<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Schedule::class, function (Faker\Generator $faker) {
    $random = rand(1, 6);
    $cleaning_steps = $faker->randomElements([1,2,3,4,5,6], $random);
    $date = $faker->dateTimeBetween($startDate = '-6 days', $endDate = '+6 days');
    $now = new \DateTime();
    if($date < $now){
        $status = $faker->randomElement(array ('unable', 'billing_success', 'billing_error'));        
    }else if($date > $now){
        $status = 'opening';
    }else{
        $status = $faker->randomElement(array ('opening', 'checkin', 'unable', 'billing_success', 'billing_error'));                
    }
    return [
        'technican_id' => 1, 
        'order_id' => 1, 
        'company_id' => 1, 
        'date' => $date, 
        'img_before' => $faker->imageUrl($width = 640, $height = 480),
        'img_after' => $faker->imageUrl($width = 640, $height = 480),
        'status' => $status,
        'cleaning_steps' => $cleaning_steps, 
        'comment' => $faker->sentence
    ];
});