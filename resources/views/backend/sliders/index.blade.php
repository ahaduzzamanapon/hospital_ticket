@extends('backend.layouts.master')

@section('title')
    Admins - Sliders
@endsection


@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Sliders</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span>Sliders</span></li>
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
                        <h4 class="header-title float-left">Sliders</h4>
                        <p class="float-right mb-2">
                            @if (Auth::guard('admin')->user()->can('admin.edit'))
                                <a class="btn btn-primary text-white" href="{{ route('admin.sliders.create') }}">Create New Slider</a>
                            @endif
                        </p>
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            @include('backend.layouts.partials.messages')
                            <table id="settingsTable" class="text-center table table-striped table-bordered">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>Sl</th>
                                        <th>Title </th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sliders as $slider)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $slider->title }}</td>
                                            <td>
                                                @if ($slider->image)
                                                    <img src="{{ asset('storage/' . $slider->image) }}" alt="Image"
                                                        width="150" height="150">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $slider->description }}</td>
                                            <td>
                                                <a class="btn btn-success text-white"
                                                    href="{{ route('admin.sliders.edit', $slider->id) }}">Edit</a>
                                                <a class="btn btn-danger text-white"
                                                    href="{{ route('admin.sliders.destroy', $slider->id) }}"
                                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $slider->id }}').submit();">
                                                    Delete
                                                </a>
                                                <form id="delete-form-{{ $slider->id }}"
                                                    action="{{ route('admin.sliders.destroy', $slider->id) }}"
                                                    method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                No Data found.
                                            </td>
                                        </tr>
                                    @endforelse
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
            $('#settingsTable').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
