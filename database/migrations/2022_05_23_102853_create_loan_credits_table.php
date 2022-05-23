<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_credits', function (Blueprint $table) {
            $table->id();
            $table->date('date')->default(now());
            $table->string('loan_provider');
            $table->unsignedBigInteger('amount');
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
        Schema::dropIfExists('loan_credits');
    }
}
