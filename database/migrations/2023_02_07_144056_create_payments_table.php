<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('referencia_id')->nullable(true);
            $table->enum('tipo', ['segunda', 'terceira', 'cheque', 'grafica_1', 'grafica_2', 'outro'])->default('outro')->nullable(true);
            $table->string('nome', 160)->nullable(true);
            $table->string('cpf_cnpj', 20)->nullable(true);
            $table->decimal('valor', 10, 2)->nullable(true);
            $table->text('descricao');
            $table->date('dt_pagamento')->nullable(true);
            $table->string('beneficiado_nome', 160)->nullable(true);
            $table->string('beneficiado_cpf_cnpj', 20)->nullable(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
