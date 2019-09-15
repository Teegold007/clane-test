<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Article::truncate();

        $faker = \Faker\Factory::create();


        factory(App\Article::class, 10)->create();

    }

}
