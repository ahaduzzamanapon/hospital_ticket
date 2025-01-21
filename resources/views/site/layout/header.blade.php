	<!-- Header Area -->

    <style>
        .section-title p {
            text-align: center;
            font-size: 30px;
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
            <div class="bookTicket-logo d-flex justify-content-center">
                <img src="{{ asset('storage/' . $setting->logo) }}" width="130" alt="">
            </div>
            <div class="section-title mt-3">
                <p class="text-center text-xl text-black">E-TICKETING PLATFORM</p>
            </div>
            
        </div>
    </header>
    <!-- End Header Area -->
