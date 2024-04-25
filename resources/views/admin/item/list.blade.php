@extends('admin.layouts.masterList')
@section('title', 'Item List')

@section('content')

    <a href="{{ route('item#list') }}" class=" text-primary text-decoration-none">Items</a>

    <div class=" d-flex justify-content-end my-3">
        <a href="{{ route('item#createPage') }}" class="btn btn-primary">
            + Add Items
        </a>
    </div>

    {{--  row control --}}
    <div class=" d-flex">
        <h3>Show: </h3>
        <form action="{{ route('item#list') }}" method="get" id="itemRollForm">
            @csrf
            <select class="form-select ms-3" id="itemRoll" name="itemRoll" aria-label="Small select example">
                <option @if ($rollCount == 10) selected @endif value="10">10 rows</option>
                <option @if ($rollCount == 20) selected @endif value="20">20 rows</option>
                <option @if ($rollCount == 30) selected @endif value="30">30 rows</option>

            </select>
        </form>
    </div>



    {{-- table --}}
    <div class=" table-responsive my-5">
        @if (count($items) == 0)
            <h1>empty item list</h1>
        @else
            <table class="table table-hover">
                <thead class=" table-primary">
                    <tr>
                        <th scope="col" class=" text-center">Action</th>
                        <th scope="col">No</th>
                        <th scope="col">Item <i class="fa-solid fa-angle-down"></i></th>
                        <th scope="col">Category <i class="fa-solid fa-angle-down"></i></th>
                        <th scope="col">Description <i class="fa-solid fa-angle-down"></i></th>
                        <th scope="col">Price <i class="fa-solid fa-angle-down"></i></th>
                        <th scope="col">Owner <i class="fa-solid fa-angle-down"></i></th>
                        <th scope="col">Publish <i class="fa-solid fa-angle-down"></i></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <th scope="row" class=" d-flex justify-content-center">
                                {{-- edit --}}
                                <a href="{{ route('item#editPage', ['id' => $item->item_id]) }}"
                                    class="btn btn-success me-2">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                {{-- delete --}}
                                <a type="button" class="btn btn-danger ms-2 z-10" data-bs-toggle="modal"
                                    data-bs-target='#deleteModal{{ $item->item_id }}'>
                                    <i class="fa-solid fa-trash"></i>
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $item->item_id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $item->item_id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deleteModalLabel{{ $item->item_id }}">
                                                    Alert!</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Delete item {{ $item->name }} ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="{{ route('item#delete', ['id' => $item->item_id]) }}"
                                                    type="button" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <td>{{ $item->item_id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @foreach ($categories as $category)
                                    @if ($category->category_id == $item->category_id)
                                        {{ $category->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $item->description }}</td>
                            <td>${{ $item->price }}</td>
                            <td>{{ $item->owner_name }}</td>

                            <td>
                                {{-- switch --}}
                                <form action="{{ route('item#editFast', ['id' => $item->item_id]) }}" method="post"
                                    class="" id="switchForm{{ $item->item_id }}">
                                    @csrf
                                    <div class="form-check form-switch">
                                        <input class="form-check-input formSwitch" type="checkbox" role="switch"
                                            id="switch{{ $item->item_id }}" name="publishSwitch"
                                            @if ($item->status == 'publish') checked @endif
                                            onclick='switchForm{{ $item->item_id }}.submit()'>
                                    </div>

                                </form>

                            </td>
                        </tr>
                    @endforeach



                </tbody>
            </table>
        @endif
    </div>

    {{--  pagination --}}
    <div class="row">
        <div class=" d-flex justify-content-end">

            <div class="custom-pagination">
                {{ $items->links() }}
            </div>
        </div>
    </div>

@endsection
