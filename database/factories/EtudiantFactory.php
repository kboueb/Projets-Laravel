<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Etudiant;
use Faker\Generator as Faker;

$factory->define(Etudiant::class, function (Faker $faker) {
    return [
        'name' =>$faker->firstName($gender = null|'male'|'female'),
        'phone' =>$faker->e164PhoneNumber,
        'email' =>$faker->freeEmail,
        'password' =>$faker->password,
        'photo' =>$faker->imageUrl($width = 640, $height = 480),
        'address' =>$faker->address,
        'gender' =>$faker->title($gender = null|'male'|'female'),
    ];
});
