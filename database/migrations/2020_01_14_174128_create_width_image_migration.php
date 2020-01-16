<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidthImageMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('founder', function (Blueprint $table) {
            $table->integer('image_width')->after('images')->nullable();
            $table->integer('image_height')->after('image_width')->nullable();
            $table->integer('image_border_top_left_radius')->after('image_height')->nullable();
            $table->integer('image_border_top_right_radius')->after('image_border_top_left_radius')->nullable();
            $table->integer('image_border_bottom_left_radius')->after('image_border_top_right_radius')->nullable();
            $table->integer('image_border_bottom_right_radius')->after('image_border_bottom_left_radius')->nullable();
            $table->string('image_alignment',15)->after('image_border_bottom_right_radius')->nullable();
        });

        Schema::table('pengurus', function (Blueprint $table) {
            $table->integer('image_width')->after('images')->nullable();
            $table->integer('image_height')->after('image_width')->nullable();
            $table->integer('image_border_top_left_radius')->after('image_height')->nullable();
            $table->integer('image_border_top_right_radius')->after('image_border_top_left_radius')->nullable();
            $table->integer('image_border_bottom_left_radius')->after('image_border_top_right_radius')->nullable();
            $table->integer('image_border_bottom_right_radius')->after('image_border_bottom_left_radius')->nullable();
            $table->string('image_alignment',15)->after('image_border_bottom_right_radius')->nullable();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->integer('image_width')->after('featured_image')->nullable();
            $table->integer('image_height')->after('image_width')->nullable();
            $table->integer('image_border_top_left_radius')->after('image_height')->nullable();
            $table->integer('image_border_top_right_radius')->after('image_border_top_left_radius')->nullable();
            $table->integer('image_border_bottom_left_radius')->after('image_border_top_right_radius')->nullable();
            $table->integer('image_border_bottom_right_radius')->after('image_border_bottom_left_radius')->nullable();
            $table->string('image_alignment',15)->after('image_border_bottom_right_radius')->nullable();
        });

        Schema::table('post_files', function (Blueprint $table) {
            $table->integer('image_width')->after('file')->nullable();
            $table->integer('image_height')->after('image_width')->nullable();
            $table->integer('image_border_top_left_radius')->after('image_height')->nullable();
            $table->integer('image_border_top_right_radius')->after('image_border_top_left_radius')->nullable();
            $table->integer('image_border_bottom_left_radius')->after('image_border_top_right_radius')->nullable();
            $table->integer('image_border_bottom_right_radius')->after('image_border_bottom_left_radius')->nullable();
            $table->string('image_alignment',15)->after('image_border_bottom_right_radius')->nullable();
        });

        Schema::table('gallery_file', function (Blueprint $table) {
            $table->integer('image_width')->after('file')->nullable();
            $table->integer('image_height')->after('image_width')->nullable();
            $table->integer('image_border_top_left_radius')->after('image_height')->nullable();
            $table->integer('image_border_top_right_radius')->after('image_border_top_left_radius')->nullable();
            $table->integer('image_border_bottom_left_radius')->after('image_border_top_right_radius')->nullable();
            $table->integer('image_border_bottom_right_radius')->after('image_border_bottom_left_radius')->nullable();
            $table->string('image_alignment',15)->after('image_border_bottom_right_radius')->nullable();
        });

        Schema::table('carousel', function (Blueprint $table) {
            $table->integer('image_width')->after('image')->nullable();
            $table->integer('image_height')->after('image_width')->nullable();
            $table->integer('image_border_top_left_radius')->after('image_height')->nullable();
            $table->integer('image_border_top_right_radius')->after('image_border_top_left_radius')->nullable();
            $table->integer('image_border_bottom_left_radius')->after('image_border_top_right_radius')->nullable();
            $table->integer('image_border_bottom_right_radius')->after('image_border_bottom_left_radius')->nullable();
            $table->string('image_alignment',15)->after('image_border_bottom_right_radius')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('width_image_migration');
    }
}
