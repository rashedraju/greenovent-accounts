<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionAprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_aprovals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_aproval_type_id')->constrained('transaction_aproval_types', 'id');
            $table->string('note')->nullable();
            $table->unsignedBigInteger('transaction_aprovalable_id');
            $table->string('transaction_aprovalable_type');
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
        Schema::dropIfExists('transaction_aprovals');
    }
}
