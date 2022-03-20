<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsFinancesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'accounts_finances', function ( Blueprint $table ) {
            $table->id();
            $table->unsignedBigInteger( 'cash' )->default( 0 );
            $table->unsignedBigInteger( 'bank' )->default( 0 );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'accounts_finances' );
    }
}
