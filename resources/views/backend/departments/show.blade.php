@extends('backend.layouts.master')

@section('title')
    Show Departments
@endsection


@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left"> Departments Details</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span>All Departments</span></li>
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
                        <h4 class="header-title float-left">Departments Details</h4>
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            @include('backend.layouts.partials.messages')
                            <table id="departmentsTable" class="text-center table table-striped table-bordered ">
                                <tr>
                                    <td>Department Name</td>
                                    <td>{{ $department->name }}</td>
                                </tr>
                                <tr>
                                    <td>Department Description</td>
                                    <td>{{ $department->description }}</td>
                                </tr>
                                <tr>
                                    <td>Department Phone</td>
                                    <td>{{ $department->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Department Fees</td>
                                    <td>{{ $department->fees }}</td>
                                </tr>
                                <tr>
                                    <td>Department Room Number</td>
                                    <td>{{ $department->room_number }}</td>
                                </tr>
                                <tr>
                                    <td>Department Total Slot</td>
                                    <td>{{ $department->total_slot }}</td>
                                </tr>
                                <tr>
                                    <td>Department Fees</td>
                                    <td>{{ $department->fees }}</td>
                                </tr>
                                <tr>
                                    <td>Department Time Slots</td>
                                    <td>
                                        @forelse ($department->timeSlots as $slot)
                                            <p>{{ $slot->time_slot }}</p>
                                        @empty
                                            <p>No time slots available</p>
                                        @endforelse
                                    </td>
                                </tr>
                                <tr>
                                    <td>Department Total Ticket</td>
                                    <td>
                                        @forelse ($department->timeSlots as $slot)
                                            <p>{{ $slot->total_ticket }}</p>
                                        @empty
                                            <p>No Ticket available</p>
                                        @endforelse
                                    </td>
                                </tr>
                                {{-- <tbody>
                                    @foreach ($departments as $department)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $department->name }}</td>
                                            <td>{{ $department->description }}</td>
                                            <td>{{ $department->phone }}</td>
                                            <td>{{ $department->fees }}</td>
                                            <td>{{ $department->room_number }}</td>
                                            <td>{{ $department->total_slot }}</td>
                                            <td>
                                                <a class="btn btn-success text-white"
                                                    href="{{ route('admin.departments.edit', $department->id) }}">Edit</a>


                                                <a class="btn btn-danger text-white"
                                                    href="{{ route('admin.departments.destroy', $department->id) }}"
                                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $department->id }}').submit();">
                                                    Delete
                                                </a>
                                                <form id="delete-form-{{ $department->id }}"
                                                    action="{{ route('admin.departments.destroy', $department->id) }}"
                                                    method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> --}}
                            </table>
                        </div>
                        {{-- <div class="d-flex justify-content-center mt-4">
                        {{ $departments->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection


