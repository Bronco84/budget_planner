<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_user', function (Blueprint $table) {
            $table->id();
            $table->integer('budget_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::dropIfExists('groups');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_user');
    }
}
