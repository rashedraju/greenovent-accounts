<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsBillsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'accounts_bills', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId('client_id');
            $table->date( 'date' )->default(now());
            $table->string( 'description' )->nullable();
            $table->string( 'bill_no' )->nullable();
            $table->unsignedBigInteger( 'invoice_amount' )->default( 0 );
            $table->unsignedBigInteger( 'vat' )->default( 0 );
            $table->unsignedBigInteger( 'gross_invoice_value' )->default( 0 );
            $table->unsignedBigInteger( 'ait' )->default( 0 );
            $table->unsignedBigInteger( 'cash_suppose_to_receipt' )->default( 0 );
            $table->string( 'receipt_number' )->nullable();
            $table->date( 'receipt_date' )->nullable();
            $table->unsignedBigInteger( 'cash_cheque_receipt' )->default( 0 );
            $table->unsignedBigInteger( 'advance' )->default( 0 );
            $table->unsignedBigInteger( 'discount' )->default( 0 );
            $table->unsignedBigInteger( 'due' )->default( 0 );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'accounts_bills' );
    }
}
