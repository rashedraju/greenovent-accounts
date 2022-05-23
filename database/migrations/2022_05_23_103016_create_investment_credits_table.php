<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_credits', function (Blueprint $table) {
            $table->id();
            $table->date('date')->default(now());
            $table->string('company_name');
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
        Schema::dropIfExists('investment_credits');
    }
}
