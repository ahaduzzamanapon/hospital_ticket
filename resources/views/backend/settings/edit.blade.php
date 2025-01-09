@extends('backend.layouts.master')

@section('title')
    Settings Edit - Admin Panel
@endsection

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .form-check-label {
            text-transform: capitalize;
        }

        .image-preview {
            display: block;
            margin-top: 10px;
            max-height: 100px;
        }
    </style>
@endsection

@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Settings Edit</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.settings.index') }}">All Settings</a></li>
                        <li><span>Edit Settings</span></li>
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
                        <h4 class="header-title">Edit Setting</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="Title English">Title English</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en"
                                        value="{{ old('title_en', $setting->title_en) }}" placeholder="Enter Title">
                                    @error('title_en')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="Title Bengali">Title Bengla</label>
                                    <input type="text" class="form-control" id="title_bn" name="title_bn"
                                        value="{{ old('title_bn', $setting->title_bn) }}" placeholder="Enter Title">
                                    @error('title_bn')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="logo">Logo <span class="text-danger">(image must be less than 2048kb (jpeg,png,jpg,gif))</span></label>
                                    <input type="file" class="form-control" id="logo" name="logo"
                                        onchange="previewImage(event, 'logoPreview')">
                                    @if ($setting->logo)
                                        <img src="{{ asset('storage/' . $setting->logo) }}" id="logoPreview"
                                            class="image-preview" alt="Logo">
                                    @else
                                        <img id="logoPreview" class="image-preview" alt="Logo Preview">
                                    @endif
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="favicon">Favicon <span class="text-danger">(image must be less than 512kb (jpeg,png,jpg,gif))</span></label>
                                    <input type="file" class="form-control" id="favicon" name="favicon"
                                        onchange="previewImage(event, 'faviconPreview')">
                                    @if ($setting->favicon)
                                        <img src="{{ asset('storage/' . $setting->favicon) }}" id="faviconPreview"
                                            class="image-preview" alt="Favicon">
                                    @else
                                        <img id="faviconPreview" class="image-preview" alt="Favicon Preview">
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="address">Address English</label>
                                    <input type="text" class="form-control" id="address_en" name="address_en"
                                        value="{{ old('address_en', $setting->address_en) }}" placeholder="Enter Address">
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="address">Address Bengla</label>
                                    <input type="text" class="form-control" id="address_bn" name="address_bn"
                                        value="{{ old('address_bn', $setting->address_bn) }}" placeholder="Enter Address">
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById(previewId);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
