<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Models\Patient;

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
    public function book_ticket_patient(){
        dd(session('Patient'));
    }
}
