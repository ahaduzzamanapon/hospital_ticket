@extends('site\layout\main')


@section('title')
    Site Feature @parent
@stop

@section('content')

    <section class="verifyNumber">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Verify Number</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="verifyNumber-card" style="justify-items: center;">
                        <div class="otp-Form number">
                            <span class="mainHeading">Enter your mobile number</span>
                            <div class="inputContainer">
                                <input type="number" class="number-input-form" id="number-input" placeholder="Enter your mobile number">
                            </div>
                            <button class="verifyButton" type="submit">Verify</button>
                            <p class="resendNote">Didn't receive the code? <button class="resendBtn">Resend Code</button>
                            </p>
                        </div>
                        <div class="otp-Form otp d-none">
                            <span class="mainHeading">Enter OTP</span>
                            <p class="otpSubheading">We have sent a verification code to your mobile number</p>
                            <div class="inputContainer">
                                <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input1">
                                <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input2">
                                <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input3">
                                <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input4">
                            </div>
                            <button class="verifyButton" type="submit">Verify</button>
                            <p class="resendNote">Didn't receive the code? <button class="resendBtn">Resend Code</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@stop
