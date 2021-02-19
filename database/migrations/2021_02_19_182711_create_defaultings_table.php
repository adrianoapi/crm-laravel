<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defaultings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('student_id');
            $table->date('dt_inadimplencia')->nullable(true);
            $table->integer('m_parcela')->nullable(true);
            $table->integer('m_parcela_pg')->nullable(true);
            $table->integer('m_parcela_ab')->nullable(true);
            $table->decimal('m_parcela_valor', 10, 2)->nullable(true);
            $table->decimal('m_parcela_total', 10, 2)->nullable(true);
            $table->integer('s_parcela')->nullable(true);
            $table->integer('s_parcela_pg')->nullable(true);
            $table->integer('s_parcela_ab')->nullable(true);
            $table->decimal('s_parcela_valor', 10, 2)->nullable(true);
            $table->decimal('s_parcela_total', 10, 2)->nullable(true);
            $table->decimal('multa', 10, 2)->nullable(true);
            $table->decimal('total', 10, 2)->nullable(true);
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
        Schema::dropIfExists('defaultings');
    }
}
