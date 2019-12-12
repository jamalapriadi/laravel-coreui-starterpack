<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStrukturOrganisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jabatan', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name',191)->nullable();
            $table->timestamps();
        });


        Schema::create('position', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name',191)->nullable();
            $table->timestamps();
        });

        Schema::create('jabatan_has_position', function (Blueprint $table) {
            $table->unsignedBigInteger('jabatan_id');
            $table->unsignedBigInteger('position_id');
        });

        Schema::create('founder', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name',191)->nullable();
            $table->text('description')->nullable();
            $table->string('images',191)->nullable();
            $table->unsignedBigInteger('author');
            $table->timestamps();
        });

        Schema::create('pengurus', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('email',65)->nullable();
            $table->string('name',191)->nullable();
            $table->text('description')->nullable();
            $table->string('images',191)->nullable();
            $table->string('no_hp',15);
            $table->unsignedBigInteger('author');
            $table->timestamps();
        });

        Schema::create('pengurus_has_posisi', function(Blueprint $table){
            $table->unsignedBigInteger('pengurus_id');
            $table->unsignedBigInteger('position_id');
            $table->date('tgl_menjabat')->nullable();
            $table->enum('active',['Y','N'])->default('Y');
            $table->timestamps();
        });

        Schema::create('pengurus_has_sosmed', function (Blueprint $table) {
            $table->unsignedBigInteger('pengurus_id');
            $table->unsignedBigInteger('sosmed_id');
            $table->string('account_id',191)->nullable();
            $table->string('account_name',191)->nullable();
            $table->unsignedBigInteger('author');
        });

        /**================ CREATE RELATION */
        Schema::table('jabatan_has_position',function(Blueprint $table){
            $table->foreign('jabatan_id')
                ->references('id')
                ->on('jabatan')
                ->onDelete('cascade');

            $table->foreign('position_id')
                ->references('id')
                ->on('position')
                ->onDelete('cascade');
        });

        Schema::table('pengurus',function(Blueprint $table){
            $table->foreign('author')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('pengurus_has_sosmed',function(Blueprint $table){
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
        Schema::dropIfExists('struktur_organisasi');
    }
}
