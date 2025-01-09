@extends('backend.layouts.master')

@section('title')
    Settings Create - Admin Panel
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
                    <h4 class="page-title pull-left">Settings Create</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.settings.index') }}">All Settings</a></li>
                        <li><span>Create Settings</span></li>
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
                        <h4 class="header-title">Create New Setting</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="Title English">Title English</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Enter Title">
                                    @error('title_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="Title Bengali">Title Bengla</label>
                                    <input type="text" class="form-control" id="title_bn" name="title_bn" placeholder="Enter Title">
                                    @error('title_bn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="logo">Logo <span class="text-danger">(image must be less than 2048kb (jpeg,png,jpg,gif))</span></label>
                                    <input type="file" class="form-control" id="logo" name="logo"
                                        placeholder="Enter Logo">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="favicon">Favicon <span class="text-danger">(image must be less than 512kb (jpeg,png,jpg,gif))</span></label>
                                    <input type="file" class="form-control" id="favicon" name="favicon"
                                        placeholder="Enter Favicon">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="address">Address English</label>
                                    <input type="text" class="form-control" id="address_en" name="address_en"
                                        placeholder="Enter Address">
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="address">Address Bengla</label>
                                    <input type="text" class="form-control" id="address_bn" name="address_bn"
                                        placeholder="Enter Address">
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        })
    </script>
@endsection
