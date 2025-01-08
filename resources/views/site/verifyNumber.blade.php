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
                        <div class="otp-Form number col-md-4" id="numberSection">
                            <span class="mainHeading">Enter your mobile number</span>
                            <div class="inputContainer">
                                <div class="form-group" style="display: flex;align-items: center;flex-direction: row;">
                                    <div class="previous" style="border: 1px solid #cccccc;padding: 3px;">
                                        +88
                                    </div>
                                    <input type="number" class="number-input-form form-control" id="number-input-for-otp"
                                        value="" placeholder="XXXXXXXXX" pattern=".{11,}" title="At least 11 numbers">
                                    <style>
                                        .number-input-form:invalid {
                                            border: 1px solid red;
                                        }
                                    </style>
                                </div>
                            </div>
                            <button class="verifyButton" type="submit" id="getOtp">Get OTP <span
                                    class="loader_verify d-none"><i class="fa fa-spinner fa-spin"></i></span> </button>
                        </div>
                        <div class="otp-Form otp d-none" id="otpSection">
                            <span class="mainHeading">Enter OTP</span>
                            <p class="otpSubheading">We have sent a verification code to your mobile number</p>
                            <div class="inputContainer">
                                <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input1">
                                <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input2">
                                <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input3">
                                <input required="required" maxlength="1" type="text" class="otp-input" id="otp-input4">
                            </div>
                            <button class="verifyButton" type="button" id="verifyOtp">Verify
                                <span class="loader_verify d-none"><i class="fa fa-spinner fa-spin"></i></span>
                            </button>
                            <p class="resendNote">Didn't receive the code? <button class="resendBtn" onclick="resendOtp()"
                                    disabled id="resendBtn">Resend Code in 1 minute</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


@section('scripts')
    <script>
        $(document).ready(function() {

            $('#number-input-for-otp').on('input', function() {
                if ($(this).val().length == 11) {
                    $('#getOtp').focus();
                }
            })

            $('#getOtp').on('click', function() {

                const number = $('#number-input-for-otp').val()
                if (number == '' || number == null || number == undefined || number.length < 11) {
                    alert('Invalid Mobile  Number');
                    return false;
                }

                $('.loader_verify').removeClass('d-none');
                $('#getOtp').attr('disabled', true);

                $.ajax({
                    url: "{{ route('sendOtp') }}",
                    type: 'POST',
                    data: {
                        'number': number,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        localStorage.setItem('timeLeft', 60);
                        timer()
                        $('#numberSection').slideUp();
                        $('#otpSection').removeClass('d-none');
                        $('.loader_verify').addClass('d-none');
                    }
                });
            })
            $('#verifyOtp').on('click', function() {

                const otp = $('#otp-input1').val() + $('#otp-input2').val() + $('#otp-input3').val() + $('#otp-input4')
                    .val()
                if (otp == '' || otp == null || otp == undefined || otp.length < 4) {
                    alert('Invalid OTP');
                    return false;
                }
                $('.loader_verify').removeClass('d-none');
                $('#verifyOtp').attr('disabled', true);
                document.getElementById('patientRegistrationForm').reset();

                $.ajax({
                    url: "{{ route('verifyOtp') }}",
                    type: 'POST',
                    data: {
                        'otp': otp,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                       response = JSON.parse(response);
                       console.log(response);
                        if (response.otpVerified) {
                            if (response.register) {
                                window.location = '{{ route('patient_dashboard') }}';
                            } else {
                                $('#patientRegistrationModal').modal('show');
                                $('.loader_verify').addClass('d-none');
                                $('#verifyOtp').attr('disabled', false);
                                $('#otp-input1').val('');
                                $('#otp-input2').val('');
                                $('#otp-input3').val('');
                                $('#otp-input4').val('');
                                $('#patient_phone').val(response.number);
                            }
                        }else{
                            alert('Invalid OTP');
                            $('.loader_verify').addClass('d-none');
                            $('#verifyOtp').attr('disabled', false);
                            $('#otp-input1').val('');
                            $('#otp-input2').val('');
                            $('#otp-input3').val('');
                            $('#otp-input4').val('');
                        }
                    }
                });
            })
        })
    </script>
    <script>
        function resendOtp() {
            $.ajax({
                url: "{{ route('resend') }}",
                type: 'GET',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    localStorage.setItem('timeLeft', 60);
                    timer()
                }
            });
        }
    </script>
    <script>
        function timer() {
            let timeLeft = localStorage.getItem('timeLeft') ? parseInt(localStorage.getItem('timeLeft')) : 60;
            let resendBtn = document.getElementById('resendBtn');
            let timer = setInterval(function() {
                timeLeft--;
                localStorage.setItem('timeLeft', timeLeft);
                resendBtn.innerHTML = `Resend Code in ${timeLeft} seconds`;
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    localStorage.removeItem('timeLeft');
                    resendBtn.removeAttribute('disabled');
                    resendBtn.innerHTML = 'Resend Code';
                }
            }, 1000);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#otp-input1').focus();
            $('#otp-input1').on('input', function() {
                if ($(this).val().length == 1) {
                    $('#otp-input2').focus();
                }
            })
            $('#otp-input2').on('input', function() {
                if ($(this).val().length == 1) {
                    $('#otp-input3').focus();
                }
            })
            $('#otp-input3').on('input', function() {
                if ($(this).val().length == 1) {
                    $('#otp-input4').focus();
                }
            })
            $('#otp-input4').on('input', function() {
                if ($(this).val().length == 1) {
                    $('#verifyOtp').focus();
                }
            })
        })

    </script>
    <script>
        function modalopen() {
            $('#patientRegistrationModal').modal('show');
        }
    </script>
@stop
