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
            $table->string('ctr', 20);
            $table->string('telefone', 20);
            $table->string('celular', 20);
            $table->string('email');
            $table->string('cep', 9);
            $table->string('endereco');
            $table->integer('numero');
            $table->string('complemento', 20);
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('observacao');
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
