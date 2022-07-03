<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsEmployeeLoansTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'accounts_employee_loans', function ( Blueprint $table ) {
            $table->id();
            $table->date( 'date' );
            $table->foreignId( 'user_id' )->constrained( 'users', 'id' );
            $table->unsignedBigInteger( 'amount' );
            $table->unsignedBigInteger( 'paid' )->default( 0 );
            $table->date( 'paid_date' )->nullable();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'accounts_employee_loans' );
    }
}
