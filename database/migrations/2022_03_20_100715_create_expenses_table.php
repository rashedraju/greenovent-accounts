<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('head');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('project_id')->nullable()->constrained('projects', 'id');
            $table->string('description')->nullable();
            $table->foreignId('expense_type_id')->constrained('expense_types', 'id');
            $table->foreignId('transaction_type_id')->constrained('transaction_types', 'id');
            $table->unsignedBigInteger('amount');
            $table->string('note')->nullable();
            $table->date('date');
            $table->date('modified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
