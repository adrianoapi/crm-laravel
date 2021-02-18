<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('unity_id');
            $table->string('name', 100);
            $table->string('responsavel', 100)->nullable(true);
            $table->string('cpf_cnpj', 30);
            $table->string('ctr', 20)->nullable(true);
            $table->string('telefone', 20)->nullable(true);
            $table->string('telefone_com', 20)->nullable(true);
            $table->string('celular', 20)->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('cep', 9);
            $table->string('endereco');
            $table->integer('numero');
            $table->string('complemento', 20)->nullable(true);
            $table->string('bairro');
            $table->string('cidade');
            $table->date('nascimento');
            $table->string('estado', 2);
            $table->string('observacao')->nullable(true);
            $table->boolean('negociado')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('unity_id')->references('id')->on('unities')->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
