<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecognitionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recognition_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recognition_id')->constrained('recognitions', 'id');
            $table->string('purpose');
            $table->unsignedBigInteger('rate');
            $table->unsignedBigInteger('total_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recognition_items');
    }
}
