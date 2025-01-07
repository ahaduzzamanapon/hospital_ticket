<!-- Button trigger modal -->


<!-- Modal -->
<form action="{{ route('book_ticket_for_patient') }}" method="POST" id="bookATicketForm">

<div class="modal fade" id="bookATicketModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Book a Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @csrf
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="patient_id">Patient ID</label>
                                <input type="text" class="form-control" id="patient_id_for_book_a_ticket" name="patient_id_for_book_a_ticket"  required readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="patient_id">Patient Name</label>
                                <input type="text" class="form-control" id="patient_name_for_book_a_ticket" name="patient_name_for_book_a_ticket"  required readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="patient_id">Date</label>
                                <input type="date" class="form-control" id="date_for_book_a_ticket" name="date_for_book_a_ticket"  required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="patient_id">Department</label>
                                <select name="department_id_for_book_a_ticket" id="department_id_for_book_a_ticket" class="form-control" required>
                                    @php
                                        $departments = \App\Models\Department::all();
                                    @endphp
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}->{{ $department->room_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="patient_id">Time Slot</label>
                                <select name="time_slot_id_for_book_a_ticket" id="time_slot_id_for_book_a_ticket" class="form-control" required>
                                    <option value="">Select Time Slot</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
</form>


