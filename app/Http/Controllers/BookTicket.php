<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Models\Patient;
use App\Models\TimeSlot;
use App\Models\Department;
use App\Models\Setting;
use App\Models\Ticket;
use App\Models\TransactionsTable;

class BookTicket extends Controller
{
    public function index(){

        session()->forget('otp');
        session()->forget('number');
        session()->forget('Patient');
    return view('site.verifyNumber');

    }
    public function sendOtp(){
        session()->forget('otp');
        session()->forget('number');
        session()->forget('Patient');

        $number = $_POST['number'];
        $otp=rand(1000,9999);
        $sms_body = "Your One Time Password (OTP) is ".$otp;
       @send_sms($number,$sms_body);
        session(['otp' => $otp]);
        session(['number' => $number]);
        echo 'success';
    }
    public function resend(){
        session()->forget('otp');
        session()->forget('number');
        session()->forget('Patient');

        $number = session('number');
        $otp=rand(1000,9999);
        $sms_body = "Your One Time Password (OTP) is ".$otp;
        @send_sms($number,$sms_body);
        session(['otp' => $otp]);
        session(['number' => $number]);
        echo 'success';
    }
    public function verifyOtp(){
        $otp = $_POST['otp'];
        $number = session('number');
        if($otp == session('otp')){
            $otpVerified =true;
        }
        else{
            $otpVerified =false;
        }
        $Patient= Patient::where('phone', $number)->first();
        session(['Patient' => $Patient]);
        $register=false;
        if($Patient){
            $register=true;
        }
        $data=array(
            'otpVerified'=>$otpVerified,
            'register'=>$register,
            'Patient'=>$Patient,
            'number'=>$number
        );
        echo json_encode($data);
    }



    public function patientRegistration(Request $request){
        $input=$request->all();
        // dd($input);
        // "_token" => "5jjtgBHRAG0pV7RCb2GBecyYPBCyPZTm00k2SUvz"
        // "patient_first_name" => "ahad"
        // "patient_phone" => "01737155233"
        // "date_of_birth" => "2000-01-06"
        // "patient_age" => "25 years 0 months"
        // "patient_gender" => "Male"
        // "patient_blood_group" => "B+"
        // "patient_address" => "rete
        $Patient= Patient::create(
            [
                'patient_id'=>'PL'.time(),
                'first_name'=>$input['patient_first_name'],
                'gender'=>$input['patient_gender'],
                'date_of_birth'=>$input['date_of_birth'],
                'age'=>$input['patient_age'],
                'phone'=>$input['patient_phone'],
                'email'=>'',
                'address'=>$input['patient_address'],
                'blood_group'=>$input['patient_blood_group']
            ]
        );
        if($Patient){
            session(['Patient' => $Patient]);
            echo 'success';
        }else{
            echo 'error';
        }
    }
    public function patient_dashboard(){
        if (session()->has('Patient')) {
            return view('site.patient_dashboard');
        }else{
            return redirect('/book_ticket');
        }
    }
    public function get_time_slot_by_department(){
        $department_id = $_POST['department_id'];
        $time_slots = TimeSlot::where('department_id', $department_id)->get();
        echo json_encode($time_slots);
    }

    public function book_ticket_for_patient(Request $request){
        $input=$request->all();
        $Patient= Patient::where('patient_id', $input['patient_id_for_book_a_ticket'])->first();
        $time_slot= TimeSlot::where('id', $input['time_slot_id_for_book_a_ticket'])->first();
        $department= Department::where('id', $input['department_id_for_book_a_ticket'])->first();
        $ticket= Ticket::create(
            [
                'ticket_id'=>'TK'.time(),
                'patient_id'=>$Patient->id,
                'department_id'=>$department->id,
                'time_slot_id'=>$time_slot->id,
                'date'=>$input['date_for_book_a_ticket'],
                'payment_status'=>0,
                'payment_amount'=>$department->fees
            ]
        );
        if($ticket){
            return redirect()->route('payment_process', ['ticket_id' => $ticket->ticket_id]);
        }else{
            session()->flash('error', 'Something went wrong. Please try again.');
            return redirect('/patient_dashboard');
        }
    }

    public function payment_process($ticket_id){
        $ticket = Ticket::where('ticket_id', $ticket_id)->first();
        session(['ticket_id_for_payment' => $ticket->ticket_id]);

        if (!$ticket) {
            // Handle error if ticket not found
            return redirect()->route('ticket.error')->with('error', 'Ticket not found');
        }

        $tran_id = "TXN".rand(1111111,9999999); // Unique transaction ID for every transaction
        $currency = "BDT"; // aamarPay supports USD & BDT
        $amount = $ticket->payment_amount; // Minimum amount is 10 taka for card option in aamarPay
        $store_id = "aamarpaytest";
        $signature_key = "dbb74894e82415a2f7ff0ec3a97e4183";

        // Clean the URL
        $url = "https://sandbox.aamarpay.com/jsonpost.php"; // For live transactions, use "https://secure.aamarpay.com/jsonpost.php"

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "store_id" => $store_id,
                "tran_id" => $tran_id,
                "success_url" => route('success'),
                "fail_url" => route('fail'),
                "cancel_url" => route('cancel'),
                "amount" => $amount,
                "currency" => $currency,
                "signature_key" => $signature_key,
                "desc" => "Merchant Registration Payment",
                "cus_name" => $ticket->ticket_id,
                "cus_email" => "payer@merchantcustomer.com",
                "cus_add1" => "House B-158 Road 22",
                "cus_add2" => "Mohakhali DOHS",
                "cus_city" => "Dhaka",
                "cus_state" => "Dhaka",
                "cus_postcode" => "1206",
                "cus_country" => "Bangladesh",
                "cus_phone" => "+8801704",
                "type" => "json"
            ]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        // Check for cURL error
        if ($response === false) {
            // Log the error or handle it
            $errorMessage = curl_error($curl);
            curl_close($curl);
            return response()->json(['error' => $errorMessage], 500);
        }

        curl_close($curl);

        $responseObj = json_decode($response);

        // Check if response contains payment URL
        if (isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {
            $paymentUrl = $responseObj->payment_url;
            return redirect()->away($paymentUrl);
        } else {
            // Handle error or log response
            return response()->json(['error' => 'Payment URL not received'], 500);
        }
    }


    public function success(Request $request){
        $request_id= $request->mer_txnid;
        $ticket_id= $request->cus_name;
        $url = "http://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$request_id&store_id=aamarpaytest&signature_key=dbb74894e82415a2f7ff0ec3a97e4183&type=json";

        //For Live Transection Use "http://secure.aamarpay.com/api/v1/trxcheck/request.php"

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $this->payment_status_for_ticket('success',$ticket_id,$request_id,$response);
    }
    public function fail(Request $request){
        $ticket_id= $request->cus_name;
        return $this->payment_status_for_ticket('fail',$ticket_id,$request_id=null,$response=null);
    }

    public function cancel(){
        $ticket_id = session('ticket_id_for_payment');
        return $this->payment_status_for_ticket('fail',$ticket_id,$request_id=null,$response=null);
    }

    public function payment_status_for_ticket($status,$ticket_id,$request_id,$response=null){
        if($status=='success'){
            $ticket = Ticket::where('ticket_id', $ticket_id)->first();
            $ticket->payment_status = ($status=='success')?1:0;
            $ticket->transection_id = $request_id;
            $ticket->save();
            if($response){
                $data=json_decode($response);
                $data=(array)$data;
                $transaction = TransactionsTable::create([
                    'pg_txnid' => $data['pg_txnid'],
                    'mer_txnid' => $data['mer_txnid'],
                    'risk_title' => $data['risk_title'],
                    'risk_level' => $data['risk_level'],
                    'cus_name' => $data['cus_name'],
                    'cus_email' => $data['cus_email'],
                    'cus_phone' => $data['cus_phone'],
                    'desc' => $data['desc'],
                    'cus_add1' => $data['cus_add1'],
                    'cus_add2' => $data['cus_add2'],
                    'cus_city' => $data['cus_city'],
                    'cus_state' => $data['cus_state'],
                    'cus_postcode' => $data['cus_postcode'],
                    'cus_country' => $data['cus_country'],
                    'cus_fax' => $data['cus_fax'],
                    'ship_name' => $data['ship_name'],
                    'ship_add1' => $data['ship_add1'],
                    'ship_add2' => $data['ship_add2'],
                    'ship_city' => $data['ship_city'],
                    'ship_state' => $data['ship_state'],
                    'ship_postcode' => $data['ship_postcode'],
                    'ship_country' => $data['ship_country'],
                    'merchant_id' => $data['merchant_id'],
                    'store_id' => $data['store_id'],
                    'amount' => $data['amount'],
                    'amount_bdt' => $data['amount_bdt'],
                    'amount_original' => $data['amount_original'],
                    'pay_status' => $data['pay_status'],
                    'status_code' => $data['status_code'],
                    'status_title' => $data['status_title'],
                    'cardnumber' => $data['cardnumber'],
                    'approval_code' => $data['approval_code'],
                    'payment_processor' => $data['payment_processor'],
                    'bank_trxid' => $data['bank_trxid'],
                    'payment_type' => $data['payment_type'],
                    'error_code' => $data['error_code'],
                    'error_title' => $data['error_title'],
                    'bin_country' => $data['bin_country'],
                    'bin_issuer' => $data['bin_issuer'],
                    'bin_cardtype' => $data['bin_cardtype'],
                    'bin_cardcategory' => $data['bin_cardcategory'],
                    'date' => $data['date'],
                    'date_processed' => $data['date_processed'],
                    'amount_currency' => $data['amount_currency'],
                    'rec_amount' => $data['rec_amount'],
                    'store_amount' => $data['store_amount'],
                    'processing_ratio' => $data['processing_ratio'],
                    'processing_charge' => $data['processing_charge'],
                    'ip' => $data['ip'],
                    'currency' => $data['currency'],
                    'currency_merchant' => $data['currency_merchant'],
                    'convertion_rate' => $data['convertion_rate'],
                    'opt_a' => $data['opt_a'],
                    'opt_b' => $data['opt_b'],
                    'opt_c' => $data['opt_c'],
                    'opt_d' => $data['opt_d'],
                    'verify_status' => $data['verify_status'],
                    'call_type' => $data['call_type'],
                    'email_send' => $data['email_send'],
                    'doc_recived' => $data['doc_recived'],
                    'checkout_status' => $data['checkout_status'],
                ]);
            }
            session(['ticket_id_for_print' => $ticket_id]);
            session()->flash('success', 'Payment Successful.');
        }else{
            $ticket = Ticket::where('ticket_id', $ticket_id)->first();
            $ticket->delete();
            session()->forget('ticket_id');
            session()->flash('error', 'Something went wrong. Please try again.');
        }

        // $patient = Patient::where('patient_id', $ticket->patient_id)->first();
        // session(['Patient' => $patient]);
      return redirect(route('reaction_on_sassoon',['ticket_id' => $ticket->ticket_id]));
    }
    public function reaction_on_sassoon($ticket_id){
        $Ticket = Ticket::where('ticket_id', $ticket_id)->first();
        if (!empty($Ticket)) {
            $Patient = Patient::where('id', $Ticket->patient_id)->first();
            session(['Patient' => $Patient]);
            session(['ticket_id_for_print' => $ticket_id]);
            return redirect()->route('patient_dashboard');
        }else{
            session()->flash('error', 'Something went wrong. Please try again.');
            return redirect('/book_ticket');
        }
    }

    public function patientHistory (){
        $Patient = session('Patient');
        $Ticket = Ticket::where('patient_id', $Patient->id)->orderBy('id', 'desc')->get();
        return view('site.patient_history', compact('Ticket'));
    }

    public function ticket_print($ticket_id){
        $Ticket = Ticket::where('ticket_id', $ticket_id)->first();
        $Patient = Patient::where('id', $Ticket->patient_id)->first();
        $TimeSlot = TimeSlot::where('id', $Ticket->time_slot_id)->first();
        $Department = Department::where('id', $Ticket->department_id)->first();
        $setting = Setting::first();
        // dd($settings);
        return view('site.ticket_print', compact('Ticket','Patient','TimeSlot','Department','setting'));
    }

    public function patient_logout(){
        session()->forget('Patient');
        return redirect('/book_ticket');
    }









}
