<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('category_id')->constrained('credit_categories');
            $table->foreignId('project_id')->nullable()->constrained('projects', 'id');
            $table->foreignId('loan_lender_id')->nullable()->constrained('company_loan_lenders', 'id');
            $table->foreignId('investor_id')->nullable()->constrained('company_investors', 'id');
            $table->unsignedBigInteger('amount');
            $table->foreignId('transaction_type_id')->constrained('transaction_types', 'id');
            $table->string('note')->nullable();
            $table->date('modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credits');
    }
}
