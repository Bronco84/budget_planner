<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('created_by');
            $table->string('account')->nullable();
            $table->string('category')->nullable();
            $table->integer('amount_in_cents');
            $table->string('frequency')->default('monthly');
            $table->string('parity')->nullable();
            $table->string('day_of_week')->nullable();
            $table->integer('day_of_month')->nullable();
            $table->date('date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
