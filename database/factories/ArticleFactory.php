<?php
/**
 * Created by PhpStorm.
 * User: sokunniga
 * Date: 14/09/2019
 * Time: 1:59 PM
 */
use App\Article;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id'=> 1,
        'ratings' =>$faker->unique(true)->numberBetween(1, 5)
    ];
});
