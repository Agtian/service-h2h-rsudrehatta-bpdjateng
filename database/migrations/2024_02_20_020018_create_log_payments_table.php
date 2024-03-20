<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_key_id');
            $table->string('nopembayaran', 20);
            $table->string('nokuitansi', 20);
            $table->string('nobuktibayar', 20);
            $table->bigInteger('totalbiayapelayanan')->default('0');
            $table->string('nama_pasien');
            $table->string('no_rekam_medik', 20);
            $table->text('alamat_pasien');
            $table->string('jeniskelamin', 20);
            $table->date('tanggal_lahir');
            $table->integer('usia');
            $table->string('ruangan_nama', 100);
            $table->date('tgl_pendaftaran');
            $table->tinyInteger('status_payment')->nullable()->comment('0=belum_bayar,1=lunas,2=batal_bayar');
            $table->string('payment_response_status', 20)->nullable();
            $table->string('payment_response_message', 100)->nullable();
            $table->tinyInteger('status_reversal')->nullable()->comment('0=conncection_timeout,1=connected');
            $table->string('reversal_response_status', 20)->nullable();
            $table->string('reversal_response_message', 100)->nullable();
            $table->timestamps();

            $table->foreign('api_key_id')->references('id')->on('api_keys')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_payments');
    }
};
