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
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('menu',191)->nullable();
            $table->string('menu_url',191)->nullable();
            $table->string('slug',191)->nullable();
            $table->string('thumb',191)->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('no_urut')->nullable();
            $table->enum('active',['Y','N'])->default('Y');
            $table->unsignedBigInteger('instansi_id')->nullabel();
            $table->timestamps();
        });

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
            $table->string('heading_title',191)->nullable();
            $table->string('title',191)->nullable();
            $table->string('second_title',191)->nullable();
            $table->text('teaser',191)->nullable();
            $table->text('description',191)->nullable();
            $table->text('featured_youtube',191)->nullable();
            $table->text('featured_facebook',191)->nullable();
            $table->string('featured_image',191)->nullable();
            $table->enum('comment',['open','close'])->default('open');
            $table->enum('post_status',['publish','draft','private'])->default('publish');
            $table->enum('post_type',['category','course','page','artikel','portofolio','gallery','template','event','testimoni','promo','newsletter','calendar','program'])->nullable();
            $table->enum('page_type',['text','component','url','text and component'])->nullable();
            $table->string('component_name',191)->nullable();
            $table->string('post_template',191)->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->string('sidebar_layout',191)->nullable();
            $table->string('sidebar_content',191)->nullable();
            $table->date('tanggal')->nullable();
            $table->string('jam_mulai')->nullable();
            $table->string('jam_selesai')->nullable();
            $table->string('page_url')->nullable();
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
            $table->string('title',191)->nullable();
            $table->enum('type_file',['image','video','file'])->default('image');
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

        Schema::create('gallery', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name',191)->nullable();
            $table->string('slug',191)->nullable();
            $table->text('description')->nullable();
            $table->integer('event_id')->nullable();
            $table->unsignedBigInteger('author');
            $table->timestamps();
        });

        Schema::create('gallery_file', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('gallery_id');
            $table->string('file_type',65)->nullable();
            $table->string('file',191)->nullable();
            $table->string('title',191)->nullable();
            $table->string('video_url',191)->nullable();
            $table->integer('sortir')->nullable();
            $table->unsignedBigInteger('author');
            $table->timestamps();
        });

        Schema::create('subscribes', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('first_name',65)->nullable();
            $table->string('last_name',65)->nullable();
            $table->string('email',45)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('ip_address',15)->nullable();
            $table->timestamps();
        });

        Schema::create('carousel_overlay', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->text('text')->nullable();
            $table->timestamps();
        });

        Schema::create('carousel', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('caption',65)->nullable();
            $table->text('text')->nullable();
            $table->string('image',191)->nullable();
            $table->enum('active',['Y','N'])->default('Y');
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('first_name',65)->nullable();
            $table->string('last_name',65)->nullable();
            $table->string('email',65)->nullable();
            $table->string('phone',65)->nullable();
            $table->string('ip_address',65)->nullable();
            $table->timestamps();
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

        Schema::table('gallery',function(Blueprint $table){
            $table->foreign('author')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('gallery_file',function(Blueprint $table){
            $table->foreign('gallery_id')
                ->references('id')
                ->on('gallery')
                ->onDelete('cascade');

            $table->foreign('author')
                ->references('id')
                ->on('users')
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
