<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions_tables', function (Blueprint $table) {
            $table->id();
            $table->string('pg_txnid')->unique();
            $table->string('mer_txnid');
            $table->string('risk_title');
            $table->string('risk_level');
            $table->string('cus_name');
            $table->string('cus_email');
            $table->string('cus_phone');
            $table->string('desc');
            $table->string('cus_add1');
            $table->string('cus_add2');
            $table->string('cus_city');
            $table->string('cus_state')->nullable();
            $table->string('cus_postcode')->nullable();
            $table->string('cus_country');
            $table->string('cus_fax')->nullable();
            $table->string('ship_name')->nullable();
            $table->string('ship_add1')->nullable();
            $table->string('ship_add2')->nullable();
            $table->string('ship_city')->nullable();
            $table->string('ship_state')->nullable();
            $table->string('ship_postcode')->nullable();
            $table->string('ship_country')->nullable();
            $table->string('merchant_id');
            $table->string('store_id');
            $table->decimal('amount', 10, 2);
            $table->decimal('amount_bdt', 10, 2);
            $table->decimal('amount_original', 10, 2);
            $table->string('pay_status');
            $table->string('status_code');
            $table->string('status_title');
            $table->string('cardnumber');
            $table->string('approval_code');
            $table->string('payment_processor');
            $table->string('bank_trxid');
            $table->string('payment_type');
            $table->string('error_code');
            $table->string('error_title');
            $table->string('bin_country');
            $table->string('bin_issuer');
            $table->string('bin_cardtype');
            $table->string('bin_cardcategory');
            $table->timestamp('date');
            $table->timestamp('date_processed');
            $table->decimal('amount_currency', 10, 2);
            $table->decimal('rec_amount', 10, 2);
            $table->decimal('store_amount', 10, 2);
            $table->decimal('processing_ratio', 5, 2);
            $table->decimal('processing_charge', 5, 2);
            $table->string('ip');
            $table->string('currency');
            $table->string('currency_merchant');
            $table->string('convertion_rate');
            $table->string('opt_a');
            $table->string('opt_b');
            $table->string('opt_c');
            $table->string('opt_d');
            $table->string('verify_status');
            $table->string('call_type');
            $table->string('email_send');
            $table->string('doc_recived');
            $table->string('checkout_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions_tables');
    }
};
