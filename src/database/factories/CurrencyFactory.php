<?php

use Faker\Generator as Faker;
use LaravelEnso\Countries\app\Models\Country;
use LaravelEnso\Currencies\app\Models\Currency;

$factory->define(Currency::class, function (Faker $faker) {
    $country = Country::whereNotIn('currency_code', Currency::pluck('code')->toArray())
        ->inRandomOrder()->first();

    return [
        'code' => $country->currency_code,
        'name' => $country->currency,
        'symbol' => $faker->unique()->randomLetter,
        'is_default' => Currency::default()->first() === null,
    ];
});
