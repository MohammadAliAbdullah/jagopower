<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBkashResponseTable extends Migration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concave_bkash_response', function (Blueprint $table) {
            $table->id();
            $table->string('currency');
            $table->decimal('amount', 12, 2);
            $table->string('invoice_number');
            $table->string('intent');
            $table->string('payment_id');
            $table->string('trxID')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('concave_bkash_response');
    }
}

