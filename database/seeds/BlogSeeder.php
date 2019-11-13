<?php

use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Cms\Category::create(
            [
                'category_name'=>'Uncategories',
                'slug'=>'uncategories',
                'description'=>'Uncategories'
            ]
        );

        \App\Models\Cms\Post::create(
            [
                'title'=>'Welcome',
                'slug'=>'welcome',
                'teaser'=>'Welcome to our blog',
                'description'=>'Welcome to our blog',
                'post_type'=>'artikel',
                'author'=>1
            ]
        );
    }
}
