@extends('backend.layouts.master')

@section('title')
    Admins - Settings
@endsection


@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Settings</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span>Settings</span></li>
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
                        <h4 class="header-title float-left">Settings</h4>
                        <p class="float-right mb-2">
                            @if (Auth::guard('admin')->user()->can('admin.edit'))
                                <a class="btn btn-primary text-white" href="{{ route('admin.settings.create') }}">Create
                                    New Setting</a>
                            @endif
                        </p>
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            @include('backend.layouts.partials.messages')
                            <table id="settingsTable" class="text-center table table-striped table-bordered">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>Sl</th>
                                        <th>Title English</th>
                                        <th>Title Bangla</th>
                                        <th>Logo</th>
                                        <th>Favicon</th>
                                        <th>Address EN</th>
                                        <th>Address BN</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($settings as $setting)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $setting->title_en }}</td>
                                            <td>{{ $setting->title_bn }}</td>
                                            <td>
                                                @if ($setting->logo)
                                                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo"
                                                        width="50" height="50">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($setting->favicon)
                                                    <img src="{{ asset('storage/' . $setting->favicon) }}" alt="Favicon"
                                                        width="50" height="50">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $setting->address_en }}</td>
                                            <td>{{ $setting->address_bn }}</td>
                                            <td>
                                                <a class="btn btn-success text-white"
                                                    href="{{ route('admin.settings.edit', $setting->id) }}">Edit</a>
                                                <a class="btn btn-info text-white"
                                                    href="{{ route('admin.settings.show', $setting->id) }}">Details</a>

                                                <a class="btn btn-danger text-white"
                                                    href="{{ route('admin.settings.destroy', $setting->id) }}"
                                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $setting->id }}').submit();">
                                                    Delete
                                                </a>
                                                <form id="delete-form-{{ $setting->id }}"
                                                    action="{{ route('admin.settings.destroy', $setting->id) }}"
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
