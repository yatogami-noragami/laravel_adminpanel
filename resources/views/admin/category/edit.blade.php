@extends('admin.layouts.master')
@section('title', 'Edit Category')

@section('content')

    <a href="{{ route('category#list') }}" class=" text-decoration-none text-dark">Categories
        <i class="fa-solid fa-angle-right"></i>
        <a href="{{ route('category#editPage', $category->category_id) }}" class=" text-decoration-none text-primary">Edit
            Categories</a>
    </a>

    <h5 class=" bg-secondary p-3 rounded my-3">Edit Categories</h5>
    <div class="container">
        <div class="row">
            <div class=" col-lg-6">
                <form action="{{ route('category#edit', ['id' => $category->category_id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- name --}}
                    <div class="my-3">
                        <label for="categoryName"class="form-label fw-bold fs-4">Category
                            <span class=" text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('categoryName') is-invalid @enderror"
                            value="{{ $category->name }}" id="categoryName" name="categoryName" placeholder="input name">

                        @error('categoryName')
                            <div class=" invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{--  photo --}}
                    <div class="my-3">
                        <label for="categoryPhoto" class="form-label fw-bold fs-4">Category Photo
                            <span class=" text-danger">*</span>
                        </label>

                        <h6 class=" text-muted">Recommended Size 400 x 200</h6>

                        <input type="file" id="categoryPhoto" name="categoryPhoto"
                            class="form-control imageInput @error('categoryPhoto') is-invalid @enderror"
                            onchange="handleFileSelect(event)">

                        @error('categoryPhoto')
                            <div class=" invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <img src="@if ($category->photo == null) {{ asset('storage/default.jpg') }}
                            @else
                            {{ asset('storage/' . $category->photo) }} @endif"
                            alt="" id="photoPreview" class="img img-fluid mt-3 d-block mx-auto">
                    </div>

                    {{-- status --}}
                    <div class="my-3">
                        <label for="categoryStatus" class="form-label fw-bold fs-4">Status
                        </label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="publish" id="categoryStatus"
                                name="categoryStatus" @if ($category->status == 'publish') checked @endif>
                            <label class="form-check-label" for="categoryStatus">
                                Publish
                            </label>
                        </div>
                    </div>



                    <a href="{{ route('category#list') }}" class="btn btn-outline-primary">Cancel</a>
                    <button class="btn btn-primary" type="submit">Save</button>

                </form>
            </div>
        </div>
    </div>

@endsection
