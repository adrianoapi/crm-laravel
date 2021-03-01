<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToDefaultingTradings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('defaulting_tradings', function (Blueprint $table) {
            $table->date('dt_pagamento')->nullable(true);
            $table->decimal('valor_pago', 10, 2)->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('defaulting_tradings', function (Blueprint $table) {
            $table->dropColumn('dt_pagamento');
            $table->dropColumn('valor_pago');
        });
    }
}
