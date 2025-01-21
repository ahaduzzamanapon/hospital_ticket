@extends('backend.layouts.master')

@section('title')
    Sliders Edit - Admin Panel
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
                    <h4 class="page-title pull-left">Sliders Edit</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.sliders.index') }}">All Sliders</a></li>
                        <li><span>Edit Slider</span></li>
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
                        <h4 class="header-title">Edit Slider</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="Title">Title </label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title', $slider->title) }}" placeholder="Enter Title">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="image">Image <span class="text-danger">(image must be less than 2048kb (jpeg,png,jpg,gif))</span></label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        onchange="previewImage(event, 'imagePreview')">
                                    @if ($slider->image)
                                        <img src="{{ asset('storage/' . $slider->image) }}" id="imagePreview"
                                            class="image-preview" alt="Image">
                                    @else
                                        <img id="imagePreview" class="image-preview" alt="Image Preview">
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="address">Description</label>
                                    <textarea class="form-control p-4" name="description" id="description" cols="10" rows="3">{{ old('description', $slider->description) }}</textarea>
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
