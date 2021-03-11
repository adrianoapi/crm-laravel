<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_cheques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('student_id');
            $table->string('student_name', 100)->nullable(true);
            $table->date('dt_vencimento')->nullable(true);
            $table->string('banco', 10)->nullable(true);
            $table->string('agencia', 10)->nullable(true);
            $table->string('cheque', 20)->nullable(true);
            $table->decimal('valor', 10, 2);
            $table->boolean('negociado')->default(false);
            $table->boolean('boleto')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_cheques');
    }
}
