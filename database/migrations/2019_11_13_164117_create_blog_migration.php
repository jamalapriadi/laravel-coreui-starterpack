<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('category_name',191)->nullable();
            $table->string('slug',191)->nullable();
            $table->text('description',191)->nullable();
            $table->integer('parent_id')->nullable();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('slug',191)->nullable();
            $table->string('title',191)->nullable();
            $table->text('teaser',191)->nullable();
            $table->text('description',191)->nullable();
            $table->text('featured_youtube',191)->nullable();
            $table->text('featured_facebook',191)->nullable();
            $table->string('featured_image',191)->nullable();
            $table->enum('comment',['open','close'])->default('open');
            $table->enum('post_status',['publish','draft','private'])->default('publish');
            $table->enum('post_type',['category','course','page','artikel','portofolio','gallery','template','event','testimoni'])->nullable();
            $table->string('post_template',191)->nullable();
            $table->date('tanggal')->nullable();
            $table->string('jam_mulai')->nullable();
            $table->string('jam_selesai')->nullable();
            $table->string('lokasi',191)->nullable();
            $table->float('lat')->nullable();
            $table->float('lng')->nullable();
            $table->unsignedBigInteger('author')->nullable();
            $table->integer('like_count')->nullable();
            $table->integer('di_lihat')->nullable();
            $table->integer('menu_order')->nullable();
            $table->timestamps();
        });

        Schema::create('post_category', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('category_id');
            $table->enum('type',['Category','Subcategory'])->default('Category');
        });

        Schema::create('post_comments', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('post_id');
            $table->string('author',50)->nullable();
            $table->string('email',50)->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('parent_id');
            $table->string('ip_address',30);
            $table->enum('approved',['Y','N'])->default('Y');
            $table->timestamps();
        });

        Schema::create('post_files', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('post_id');
            $table->enum('type_file',['image','video'])->default('image');
            $table->string('file',191)->nullable();
            $table->unsignedBigInteger('author');
            $table->timestamps();
        });

        Schema::create('post_related', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('related_id');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('title',191)->nullable();
            $table->string('slug',191)->nullable();
            $table->timestamps();
        });

        Schema::create('post_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');
        });

        /**================ CREATE RELATION */
        Schema::table('post_category',function(Blueprint $table){
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });

        Schema::table('post_comments',function(Blueprint $table){
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
        });

        Schema::table('post_files',function(Blueprint $table){
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreign('author')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('post_related',function(Blueprint $table){
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreign('related_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
        });

        Schema::table('post_tags',function(Blueprint $table){
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('posts');
    }
}
