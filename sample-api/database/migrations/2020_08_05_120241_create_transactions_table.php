<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTransactionTable
 */
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
            $table->foreignId('payer_user')->constrained('user');
            $table->foreignId('payee_user')->constrained('user');
            $table->double('value', 10, 2);
            $table->enum('status', ['PENDING', 'FINISHED']);
            $table->enum('notified', ['PENDING', 'FINISHED']);
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
