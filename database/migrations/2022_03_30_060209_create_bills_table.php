<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->string('date');
            $table->string('bill_no');
            $table->string('subject');
            $table->foreignId('bill_status_id')->constrained('bill_statuses', 'id');
            $table->unsignedBigInteger('total');
            $table->unsignedInteger('asf')->default(0);
            $table->unsignedInteger('vat')->default(0);
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
        Schema::dropIfExists('bills');
    }
}
