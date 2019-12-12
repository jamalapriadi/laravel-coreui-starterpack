<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstansiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instansi', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('nama_instansi',50)->nullable();
            $table->string('nama_lengkap_instansi',65)->nullable();
            $table->string('tagline',191)->nullable();
            $table->string('teaser',191)->nullable();
            $table->text('tentang')->nullable();
            $table->string('alamat',191)->nullable();
            $table->string('visi',191)->nullable();
            $table->string('misi',191)->nullable();
            $table->string('telp',15)->nullable();
            $table->string('email',30)->nullable();
            $table->string('fax',15)->nullable();
            $table->string('website',30)->nullable();
            $table->string('logo',191)->nullable();
            $table->float('lat')->nullable();
            $table->float('lng')->nullable();
            $table->timestamps();
        });

        Schema::create('instansi_video', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('instansi_id')->nullabel();
            $table->string('youtube_url',191)->nullable();
            $table->string('video_id',65)->nullable();
            $table->integer('no_urut')->nullable();
            $table->timestamps();
        });

        Schema::create('fasilitas', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('instansi_id')->nullabel();
            $table->string('name',191)->nullable();
            $table->string('deskripsi',191)->nullable();
            $table->string('icon',191)->nullable();
            $table->integer('no_urut')->nullable();
            $table->timestamps();
        });

        Schema::create('sosmed', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name',191)->nullable();
            $table->timestamps();
        });

        Schema::create('instansi_has_sosmed', function (Blueprint $table) {
            $table->unsignedBigInteger('instansi_id')->nullabel();
            $table->unsignedBigInteger('sosmed_id')->nullabel();
            $table->string('social_media_url',191)->nullable();
        });

        Schema::create('instansi_contact', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('instansi_id')->nullabel();
            $table->string('parameter_name',191)->nullable();
            $table->string('parameter_value',191)->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->enum('show_name',['Y','N'])->default('Y');
            $table->string('icon',191)->nullable();
            $table->integer('no_urut')->nullable();
            $table->timestamps();
        });

        Schema::table('instansi_has_sosmed',function(Blueprint $table){
            $table->foreign('instansi_id')
                ->references('id')
                ->on('instansi')
                ->onDelete('cascade');

            $table->foreign('sosmed_id')
                ->references('id')
                ->on('sosmed')
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
        Schema::dropIfExists('instansi');
    }
}
