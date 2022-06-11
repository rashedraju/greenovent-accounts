<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_expenses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('expense_type_id')->constrained('accounts_expense_types', 'id');
            $table->string('item')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('amount')->default(0);
            $table->foreignId('transaction_type_id')->constrained('transaction_types', 'id');
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
        Schema::dropIfExists('accounts_expenses');
    }
}
