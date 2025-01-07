@extends('site\layout\main')


@section('title')
    Patient Ticket History @parent
@stop

@section('content')

    <section class="patient_dashboard my-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div style="display: flex;justify-content: space-between;">
                                <h5 class="card-title text-center mb-4">Patient Ticket History</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <th>SL</th>
                                                <th>Ticket ID</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($Ticket as $ticket)
                                                    <tr>
                                                        <td>{{ $loop->index+1 }}</td>
                                                        <td>{{ $ticket->ticket_id }}</td>
                                                        <td>{{ $ticket->created_at }}</td>
                                                        <td>
                                                            <a onclick="getTicketPrint('{{ $ticket->ticket_id }}')"
                                                                class="btn btn-sm btn-primary" style="color: #fff">Print Ticket <i class="fa fa-print"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
