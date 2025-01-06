<!doctype html>
<html lang="en">
  <head>
    <title> @yield('title') || {{ config('app.name') }}</title>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png">
        <meta name="csrf-token" content="{{ csrf_token() }}">


    @include('site.layout.css_file')
    @yield('styles')
  </head>
  <body>
    @include('site.layout.header')
    @include('site.layout.modal.patientRegistration_modal')
    	<!-- Preloader -->
        <div class="preloader">
            <div class="loader">
                <div class="loader-outter"></div>
                <div class="loader-inner"></div>

                <div class="indicator">
                    <svg width="16px" height="12px">
                        <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                        <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <!-- End Preloader -->


    @yield('content')

    @include('site.layout.footer')
    @include('site.layout.js_file')
    @yield('scripts')
    <script>
        function calculateAge() {
            var today = new Date();
            var birthDate = new Date(document.getElementById("date_of_birth").value);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            var year = age;
            var month = (today.getMonth() + 1) - (birthDate.getMonth() + 1);
            if (month < 0) {
                year--;
                month = 12 + month;
            }
            if (year <= 0) {
                year = 0;
            }
            document.getElementById("patient_age").value = year + ' years ' + month + ' months';
        }
    </script>
    <script>
        $(document).ready(function() {

            $('#patientRegistrationForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('patientRegistration') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if(response=='success'){
                            $('#patientRegistrationModal').modal('hide');
                            window.location = '{{ route('book_ticket_patient') }}';
                        }else{
                            alert('Something went wrong');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Something went wrong');
                    }
                });
            })
        })
    </script>
  </body>
</html>
