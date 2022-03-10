<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId( 'project_id' )->constrained();
            $table->string( 'title' );
            $table->string( 'name' );
            $table->unsignedBigInteger( 'advance' );
            $table->unsignedBigInteger( 'due' );
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
        Schema::dropIfExists('vendor_costs');
    }
}
