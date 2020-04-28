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
            $table->string('name', 40);
            $table->date('date_at');
            $table->enum('type', ['income', 'expense']);
            $table->decimal('value',16,2,true);
            $table->text('note');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('category_id');
            $table->boolean('is_pay');
            $table->timestamps();
            $table->foreign('account_id')->on('accounts')->references('id');
            $table->foreign('category_id')->on('categories')->references('id');
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
