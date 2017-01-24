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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Logo::class, function (Faker\Generator $faker) {
	$upload_dir = storage_path() . '/uploads';
    return [
        'big_square' => $faker->image($dir = $upload_dir, $width = 480, $height = 480),
        'small_square' => $faker->image($dir = $upload_dir, $width = 200, $height = 200),
        'big_widescreen' => $faker->image($dir = $upload_dir, $width = 780, $height = 480),
        'small_widescreen' => $faker->image($dir = $upload_dir, $width = 325, $height = 200),
    ];
});

$factory->defineAs(App\Models\Logo::class, 'fake', function (Faker\Generator $faker) {
    $upload_dir = storage_path() . '/uploads/';
    return [
        'path' => $upload_dir . $faker->bothify('************************') . '.jpg',
    ];
});

$factory->define(App\Models\Club::class, function (Faker\Generator $faker) {
    return [
        'name' => substr($faker->company, 0, 30),
        'lat' => '49.744' . $faker->randomNumber(4, true),
        'long' => '13.377' . $faker->randomNumber(4, true),
        'age_group' => $faker->randomElement(['teen', 'twenties', 'older']),
        'email' => $faker->email,
        'phone' => $faker->randomElement(['+420', '00420', '']) . $faker->randomNumber(9),
        'music_delivery' => $faker->randomElement(['live', 'recorded' ,'mixed']),
        'opening_hours' => $faker->randomElement(['Mo8-Mo20;We17-We18', 'Mo8:30-Mo20;Mo21-Tu2', 'We15:45-Th5']),
    ];
});

$factory->define(App\Models\Artist::class, function (Faker\Generator $faker) {
    return [
        'name' => str_random(20),
        'description' => str_random(50),
    ];
});

$factory->define(App\Models\Item::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->lexify('??????? ?????'),
        'price' => $faker->randomFloat(2, 0, 123456789),
        'type' => $faker->randomElement(['drink', 'food', 'service', 'other']),
    ];
});

$factory->define(App\Models\ActionItem::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->lexify('??????? ?????'),
        'price' => $faker->randomFloat(2, 0, 123456789),
        'type' => $faker->randomElement(['drink', 'food', 'service', 'other']),
    ];
});

$factory->define(App\Models\FeatureRequest::class, function (Faker\Generator $faker) {
    return [
        'content' => str_random(50),
        'type' => $faker->randomElement(['web', 'app', 'club', 'club_items', 'action']),
    ];
});

$factory->define(App\Models\ArtistType::class, function (Faker\Generator $faker) {
    return [
        'name' => str_random(20),
    ];
});

$factory->define(App\Models\Style::class, function (Faker\Generator $faker) {
    return [
        'name' => str_random(20),
    ];
});

$factory->define(App\Models\Action::class, function (Faker\Generator $faker) {
    $date = $faker->dateTimeInInterval('- 14 days', '+ 14 days');
    return [
        'name' => str_random(20),
        'time_from' => $date,
        'time_to' => ($date->format('U') + $faker->numberBetween(1200000, 1800000)),
        'description' => str_random(40),
        'opening_hours' => $faker->randomElement(['Mo8-Mo20;We17-We18', 'Mo8:30-Mo20;Mo21-Tu2', 'We15:45-Th5']),
    ];
});

$factory->define(App\Models\ActionArtist::class, function (Faker\Generator $faker) {
    $date = $faker->dateTimeInInterval('- 14 days', '+ 14 days');
    return [
        'time_from' => $date,
        'time_to' => ($date->format('U') + $faker->numberBetween(1200, 18000)),
    ];
});

$factory->define(App\Models\SubAction::class, function (Faker\Generator $faker) {
    $date = $faker->dateTimeInInterval('- 14 days', '+ 14 days');
    return [
        'time_from' => $date,
        'time_to' => ($date->format('U') + $faker->numberBetween(1200, 18000)),
    ];
});

$factory->define(App\Models\Attribute::class, function (Faker\Generator $faker) {
    return [
        'name' => str_random(20),
        'icon_type' => $faker->randomElement(App\Enums\IconTypes::ALL_TYPES),
        'icon_name' => str_random(20)
    ];
});
