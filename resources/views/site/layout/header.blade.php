	<!-- Header Area -->

    <style>
        .section-title p {
            text-align: center;
            font-size: 20px;
            color: #2C2D3F;
            font-weight: 700;
        }
        @media only screen and (max-width: 500px) {
            .section-title p {
                text-align: center;
                font-size: 18px;
                color: #2C2D3F;
                font-weight: 700;
            }

        }
    </style>

    <header class="header" >
        <div class="col-lg-12">
            <div class="bookTicket-logo d-flex justify-content-center mt-2">
                <img src="{{ asset('storage/' . $setting->logo) }}" width="90" alt="">
            </div>
            <div class="section-title my-1">
                <p class="text-center text-xl text-black mt-0">E-TICKETING PLATFORM</p>
            </div>

            <div class="get-quote">
                @if(session()->has('Patient'))
                <div class="d-flex justify-content-center" style="gap: 10px">
                    <a href="{{ route('patient_dashboard') }}" class="btn btn-primary btn-xm mb-2">Dashboard <i class="fa fa-user"></i></a>
                    <a href="{{ route('patient_logout') }}" class="btn btn-danger btn-xm mb-2">Logout <i class="fa fa-sign-out"></i></a>
                </div>
                @endif
            </div>
            
        </div>
    </header>
    <!-- End Header Area -->
