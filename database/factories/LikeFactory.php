<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Like;
use App\Model\Reply;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        // 'reply_id' => function(){
        //     return Reply::all()->random();
        // },
        'user_id' => function(){
            return \App\User::all()->random();
        }
    ];
});
