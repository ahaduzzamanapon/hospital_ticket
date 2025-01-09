@extends('backend.layouts.master')

@section('title')
    Admins - Departments
@endsection


@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Admins</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span>All Admins</span></li>
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
                        <h4 class="header-title float-left">Departments List</h4>
                        <p class="float-right mb-2">
                            @if (Auth::guard('admin')->user()->can('admin.edit'))
                                <a class="btn btn-primary text-white" href="{{ route('admin.departments.create') }}">Create
                                    New Department</a>
                            @endif
                        </p>
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            @include('backend.layouts.partials.messages')
                            <table id="departmentsTable"
                                class="text-center table table-striped table-bordered ">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Phone</th>
                                        <th>Fees</th>
                                        <th>Room Number</th>
                                        <th>Total Slot</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                                <a class="btn btn-info text-white"
                                                    href="{{ route('admin.departments.show', $department->id) }}">Details</a>

                                                <a class="btn btn-danger text-white"
                                                    href="{{ route('admin.departments.destroy', $department->id) }}"
                                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $department->id }}').submit();">
                                                    Delete
                                                </a>
                                                <form id="delete-form-{{ $department->id }}"
                                                    action="{{ route('admin.departments.destroy', $department->id) }}" method="POST"
                                                    style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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


@section('scripts')
    <script>
        /*================================
                datatable active
                ==================================*/
        $(document).ready(function() {
            $('#departmentsTable').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
