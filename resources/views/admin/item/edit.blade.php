@extends('admin.layouts.master')
@section('title', 'Edit Item')

@section('content')

    <a href="{{ route('item#list') }}" class=" text-decoration-none text-dark">Items
        <i class="fa-solid fa-angle-right"></i>
        <a href="{{ route('item#editPage', ['id' => $item->item_id]) }}" class=" text-decoration-none text-primary">Edit
            Items</a>
    </a>

    <h5 class=" bg-secondary p-3 rounded my-3">Edit Items</h5>
    <div class="container">

        <form action="{{ route('item#edit', ['id' => $item->item_id]) }}" method="post" enctype="multipart/form-data"
            class="row">
            <div class=" col-lg-6 ">
                <h3>Item Information</h3>

                @csrf
                {{-- name --}}
                <div class="my-3">
                    <label for="itemName"class="form-label fw-bold fs-4">Item Name
                        <span class=" text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('itemName') is-invalid @enderror"
                        value="{{ $item->name }}" id="itemName" name="itemName" placeholder="input name">

                    @error('itemName')
                        <div class=" invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- category --}}
                <div class="my-3">
                    <label for="itemCategory"class="form-label fw-bold fs-4">Select Category
                        <span class=" text-danger">*</span>
                    </label>

                    <select class="form-select @error('itemCategory') is-invalid @enderror" id="itemCategory"
                        name="itemCategory" aria-label="">
                        <option disabled>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}" @if ($category->category_id == $item->category_id) selected @endif>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>


                    @error('itemCategory')
                        <div class=" invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{--  price --}}
                <div class="my-3">
                    <label for="itemPrice"class="form-label fw-bold fs-4">Price
                        <span class=" text-danger">*</span>
                    </label>
                    <input type="number" class="form-control @error('itemPrice') is-invalid @enderror"
                        value="{{ $item->price }}" id="itemPrice" name="itemPrice" placeholder="Enter Price">

                    @error('itemPrice')
                        <div class=" invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- description --}}
                <div class="my-3">
                    <label for="itemDescription"class="form-label fw-bold fs-4">Description
                        <span class=" text-danger">*</span>
                    </label>
                    <textarea id="editor" name="itemDescription" placeholder="Enter Description"
                        class=" @error('itemDescription') is-invalid @enderror">
                        {{ $item->description }}
                        </textarea>

                    @error('itemDescription')
                        <div class=" invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- condition --}}
                <div class="my-3">
                    <label for="itemCondition"class="form-label fw-bold fs-4">Select Item Condition

                    </label>

                    <select name="itemCondition" id="itemCondition"
                        class=" form-select  @error('itemCondition') is-invalid @enderror">
                        <option disabled>Select Item Condition</option>
                        <option @if ($item->condition == 'New') selected @endif value="New">New</option>
                        <option @if ($item->condition == 'Used') selected @endif value="Used">Used</option>
                        <option @if ($item->condition == 'Good Secondhand') selected @endif value="Good Secondhand">Good Secondhand
                        </option>
                    </select>

                    @error('itemCondition')
                        <div class=" invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- type --}}
                <div class="my-3">
                    <label for="itemType"class="form-label fw-bold fs-4">Select Item Type

                    </label>

                    <select name="itemType" id="itemType" class=" form-select  @error('itemType') is-invalid @enderror">
                        <option disabled>Select Item Type</option>
                        <option @if ($item->type == 'For Sell') selected @endif value="For Sell">For Sell</option>
                        <option @if ($item->type == 'For Buy') selected @endif value="For Buy">For Buy</option>
                        <option @if ($item->type == 'For Exchange') selected @endif value="For Exchange">For Exchange
                        </option>
                    </select>

                    @error('itemType')
                        <div class=" invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- status --}}
                <div class="my-3">
                    <label for="itemStatus" class="form-label fw-bold fs-4">Status

                    </label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="publish"
                            @if ($item->status == 'publish') checked @endif id="itemStatus" name="itemStatus">
                        <label class="form-check-label" for="itemStatus">
                            Publish
                        </label>
                    </div>
                </div>

                {{--  photo --}}
                <div class="my-3">
                    <label for="itemPhoto" class="form-label fw-bold fs-4">Item Photo
                        <span class=" text-danger">*</span>
                    </label>
                    <h6 class=" text-muted">Recommended Size 400 x 200</h6>

                    <input type="file" id="itemPhoto" name="itemPhoto"
                        class="form-control imageInput @error('itemPhoto') is-invalid @enderror"
                        onchange="handleFileSelect(event)">

                    @error('itemPhoto')
                        <div class=" invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <img src="@if ($item->photo == null) {{ asset('storage/default.jpg') }}
                            @else
                            {{ asset('storage/' . $item->photo) }} @endif"
                        alt="" id="photoPreview" class="img img-fluid mt-3 d-block mx-auto">
                </div>


            </div>

            <div class="col-lg-6">
                <h3>Owner Information</h3>
                {{-- owner name --}}
                <div class="my-3">
                    <label for="itemOwnerName"class="form-label fw-bold fs-4">Owner Name
                        <span class=" text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('itemOwnerName') is-invalid @enderror"
                        value="{{ $item->owner_name }}" id="itemOwnerName" name="itemOwnerName"
                        placeholder="input owner name">

                    @error('itemOwnerName')
                        <div class=" invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{--  owner contact --}}
                <div class="my-3">
                    <label for="itemOwnerContactNumber"class="form-label fw-bold fs-4">Contact Number

                    </label>
                    <div class="d-flex">
                        <select id="itemOwnerCountryCode" name="itemOwnerCountryCode" class=" form-select">
                            @foreach ($callingCodes as $callingCode)
                                <option value="{{ $callingCode }}" @if ($callingCode == $item->country_code) selected @endif>
                                    {{ $callingCode }}</option>
                            @endforeach
                        </select>

                        <input type="tel" class="form-control @error('itemOwnerContactNumber') is-invalid @enderror"
                            value="{{ $item->contact_number }}" id="itemOwnerContactNumber"
                            name="itemOwnerContactNumber" placeholder="Add Number">
                    </div>


                    @error('itemOwnerContactNumber')
                        <div class=" invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{--  owner address --}}
                <div class="my-3">
                    <label for="itemOwnerAddress"class="form-label fw-bold fs-4">Address

                    </label>
                    <input type='text' class="form-control @error('itemOwnerAddress') is-invalid @enderror"
                        value="{{ $item->address }}" id="itemOwnerAddress" name="itemOwnerAddress"
                        placeholder="Enter Address">


                    @error('itemOwnerAddress')
                        <div class=" invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div id="map" class=" my-3"></div>

                </div>


                <a href="{{ route('item#list') }}" class="btn btn-outline-primary">Cancel</a>
                <button class="btn btn-primary" type="submit">Save</button>
            </div>

        </form>

    </div>

@endsection
