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
                        <h4 class="header-title float-left">Settings Details</h4>
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            @include('backend.layouts.partials.messages')
                            <table id="departmentsTable" class="text-center table table-striped table-bordered ">
                                <tr>
                                    <td>Setting Title (EN)</td>
                                    <td>{{ $setting->title_en }}</td>
                                </tr>
                                <tr>
                                    <td>Setting Title (BN)</td>
                                    <td>{{ $setting->title_bn }}</td>
                                </tr>
                                <tr>
                                    <td>Logo</td>
                                    <td>
                                        @if ($setting->logo)
                                            <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo"
                                                width="70" height="50">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Favicon</td>
                                    <td>
                                        @if ($setting->favicon)
                                            <img src="{{ asset('storage/' . $setting->favicon) }}" alt="Favicon"
                                                width="70" height="50">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address (EN)</td>
                                    <td>{{ $setting->address_en }}</td>
                                </tr>
                                <tr>
                                    <td>Address (BN)</td>
                                    <td>{{ $setting->address_bn }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection
