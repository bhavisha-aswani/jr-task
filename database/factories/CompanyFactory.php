<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Illuminate\Http\File;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->unique()->companyEmail,
        'logo' => $faker->image('public/storage/logo',100,100, null, false),
        'website' => $faker->url,
    ];
});
