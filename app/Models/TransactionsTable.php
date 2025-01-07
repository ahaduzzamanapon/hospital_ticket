<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionsTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'pg_txnid', 'mer_txnid', 'risk_title', 'risk_level', 'cus_name', 'cus_email', 'cus_phone', 'desc',
        'cus_add1', 'cus_add2', 'cus_city', 'cus_state', 'cus_postcode', 'cus_country', 'cus_fax',
        'ship_name', 'ship_add1', 'ship_add2', 'ship_city', 'ship_state', 'ship_postcode', 'ship_country',
        'merchant_id', 'store_id', 'amount', 'amount_bdt', 'amount_original', 'pay_status', 'status_code',
        'status_title', 'cardnumber', 'approval_code', 'payment_processor', 'bank_trxid', 'payment_type',
        'error_code', 'error_title', 'bin_country', 'bin_issuer', 'bin_cardtype', 'bin_cardcategory',
        'date', 'date_processed', 'amount_currency', 'rec_amount', 'store_amount', 'processing_ratio',
        'processing_charge', 'ip', 'currency', 'currency_merchant', 'convertion_rate', 'opt_a', 'opt_b',
        'opt_c', 'opt_d', 'verify_status', 'call_type', 'email_send', 'doc_recived', 'checkout_status'
    ];
}
