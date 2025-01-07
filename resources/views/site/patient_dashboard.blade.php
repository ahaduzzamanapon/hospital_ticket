@extends('site\layout\main')


@section('title')
    Site Feature @parent
@stop

@section('content')

    <section class="patient_dashboard my-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div style="display: flex;justify-content: space-between;">
                                <h5 class="card-title text-center mb-4">Patient Dashboard</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    @php
                                        $patient = session('Patient');
                                    @endphp
                                    <ul class="list-unstyled">
                                        <li><strong>ID:</strong> {{ $patient->patient_id }}</li>
                                        <li><strong>Name:</strong> {{ $patient->first_name }}</li>
                                        <li><strong>Gender:</strong> {{ $patient->gender }}</li>
                                        <li><strong>Age:</strong> {{ $patient->age }}</li>
                                        <li><strong>Phone:</strong> {{ $patient->phone }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6 text-md-right text-center mt-3 mt-md-0">
                                    <div>
                                        <a onclick="getTicketForm()" class="btn btn-primary btn-xl mb-2" style="color: #fff">Book a ticket <i
                                                class="fa fa-ticket"></i></a>
                                        <a href="{{ route('patientHistory') }}" class="btn btn-info btn-sm mb-2" style="color: #fff"> History <i
                                                class="fa fa-history"></i></a>
                                    </div>
                                </div>
                            </div>
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
            console.log("ready!");

        })
    </script>
    <script>
        function getTicketForm() {
            $('#bookATicketForm').trigger('reset');
            $('#bookATicketModal').modal('show');
            var patient_data = {!! json_encode(session('Patient')) !!};
            $('#patient_id_for_book_a_ticket').val(patient_data.patient_id);
            $('#patient_name_for_book_a_ticket').val(patient_data.first_name);
        }
    </script>

@stop
