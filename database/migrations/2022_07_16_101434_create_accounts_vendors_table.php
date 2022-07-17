<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsVendorsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'accounts_vendors', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId( 'vendor_id' )->constrained( 'vendors', 'id' );
            $table->string( 'description' )->nullable();
            $table->date( 'date_bill' )->nullable();
            $table->string( 'bill_no' )->nullable();
            $table->unsignedDouble( 'bill_amount' )->default( 0 );
            $table->date( 'date_adv' )->nullable();
            $table->unsignedDouble( 'advance' )->default( 0 );
            $table->date( 'date_pay' )->nullable();
            $table->unsignedDouble( 'paid' )->default( 0 );
            $table->unsignedDouble( 'due' )->default( 0 );
            $table->string( 'project_name' )->nullable();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'accounts_vendors' );
    }
}
