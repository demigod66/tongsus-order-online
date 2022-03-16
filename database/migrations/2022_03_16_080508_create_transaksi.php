<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi');
            $table->integer('user_id');
            $table->integer('subtotal');
            $table->string('status');
            $table->string('pesan');
            $table->string('type_bayar');
            $table->string('type_bank');
            $table->string('va_number');
            $table->string('keterangan');
            $table->text('pdf_url');
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
        Schema::dropIfExists('transaksi');
    }
}
