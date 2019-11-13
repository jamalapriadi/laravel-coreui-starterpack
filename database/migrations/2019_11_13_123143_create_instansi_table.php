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
            $table->bigIncrements('id');
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
