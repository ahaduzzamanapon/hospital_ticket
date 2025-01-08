@extends('backend.layouts.master')

@section('title')
    Edit Department - Admin Panel
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
@endsection

@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Edit Department</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.departments.index') }}">All Departments</a></li>
                        <li><span>Edit Department</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                @include('backend.layouts.partials.logout')
            </div>
        </div>
    </div>
    <!-- page title area end -->

    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Edit Department</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.departments.update', $department->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="department_name">Department Name</label>
                                    <input type="text" class="form-control" id="department_name" name="department_name"
                                        value="{{ old('department_name', $department->name) }}" placeholder="Enter Name">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="description">Description</label><br>
                                    <textarea name="description" id="description" style="width: 100%; padding: 10px;" rows="3">{{ old('description', $department->description) }}</textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone', $department->phone) }}" placeholder="Enter Phone">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="fees">Fees</label>
                                    <input type="text" class="form-control" id="fees" name="fees"
                                        value="{{ old('fees', $department->fees) }}" placeholder="Enter Fees">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="time_slot">Time Slots</label>
                                    <div id="dynamic_fields">
                                        @foreach ($department->timeSlots as $key => $timeSlot)
                                            <div class="d-flex mt-2">
                                                <input type="text" class="form-control m-1" name="time_slot[]" value="{{ $timeSlot->time_slot }}" required>
                                                <input type="text" class="form-control m-1" name="total_ticket[]" value="{{ $timeSlot->total_ticket }}" required>
                                                @if ($key === 0)
                                                    <button type="button" class="btn btn-primary ml-2 click_add">Add</button>
                                                @else
                                                    <button type="button" class="btn btn-danger ml-2 click_remove">Remove</button>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="room_number">Room Number</label>
                                    <input type="text" class="form-control" id="room_number" name="room_number"
                                        value="{{ old('room_number', $department->room_number) }}" placeholder="Enter Room Number">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.click_add').on('click', function() {
                $('#dynamic_fields').append(`
                <div class="d-flex mt-2">
                    <input type="text" class="form-control m-1" name="time_slot[]" placeholder="Enter Time Slot" required>
                    <input type="text" class="form-control m-1" name="total_ticket[]" placeholder="Enter Ticket" required>
                    <button type="button" class="btn btn-danger ml-2 click_remove">Remove</button>
                </div>
            `);
            });

            $(document).on('click', '.click_remove', function() {
                $(this).closest('.d-flex').remove();
            });
        });
    </script>
@endsection
