<?php

/** @var Factory $factory */

use App\Models\Payer\User;
use App\Models\Payer\Wallet;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

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

$factory->define(User::class, function (Faker $faker) {
    $document = mt_rand(str_pad(9, 10, '9', STR_PAD_RIGHT), str_pad(9, 11, '9', STR_PAD_RIGHT));
    $documentType = 'CPF';

    if (mt_rand(1, 2) % 2 == 0) {
        $document = mt_rand(str_pad(9, 13, '9', STR_PAD_RIGHT), str_pad(9, 14, '9', STR_PAD_RIGHT));
        $documentType = 'CNPJ';
    }

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => md5(microtime()),
        'document' => $document,
        'document_type' => $documentType
    ];
});

$factory->define(Wallet::class, function (Faker $faker) {
    return [
        'amount' => mt_rand(1000, 10000) / 100,
    ];
});
