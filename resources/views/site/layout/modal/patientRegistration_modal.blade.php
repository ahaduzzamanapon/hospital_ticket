<!-- Button trigger modal -->


<!-- Modal -->
<form action="#" id="patientRegistrationForm">

<div class="modal fade" id="patientRegistrationModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Patient Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @csrf
                    <div class="container">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="patient_first_name" name="patient_first_name" aria-describedby="first_name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control"  id="patient_phone" name="patient_phone" aria-describedby="phone" required readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" onchange="calculateAge()" max="{{ date('Y-m-d') }}" class="form-control" id="date_of_birth" name="date_of_birth" aria-describedby="date_of_birth" placeholder="YYYY-MM-DD" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="patient_age">Age</label>
                                <input type="text" class="form-control" id="patient_age" name="patient_age" readonly required>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="patient_gender" name="patient_gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blood_group">Blood Group</label>
                                <select class="form-control" id="patient_blood_group" name="patient_blood_group">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="patient_address" rows="3" name="patient_address"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="window.location.reload()" data-dismiss="modal">Close</button>
                <button type="submit"  class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
</form>


