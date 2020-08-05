<?php

use Illuminate\Database\Seeder;
use \App\Models\Payer\User;
use \App\Models\Payer\Wallet;

/**
 * Class UserSeeder
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 50)->create()->each(function ($user) {
            /* @var User $user */
            $user->wallet()->save(factory(Wallet::class)->make());
        });
    }
}
