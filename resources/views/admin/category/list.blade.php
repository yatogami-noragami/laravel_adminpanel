@extends('admin.layouts.masterList')
@section('title', 'Category List')

@section('content')

    <a href="{{ route('category#list') }}" class=" text-primary text-decoration-none">Categories</a>


    <div class=" d-flex justify-content-end my-3">
        <a href="{{ route('category#createPage') }}" class="btn btn-primary">
            + Add Categories
        </a>
    </div>

    {{-- row control --}}
    <div class=" d-flex">
        <h3>Show: </h3>
        <form action="{{ route('category#list') }}" method="get" id="categoryRollForm">
            @csrf
            <select class="form-select ms-3" id="categoryRoll" name="categoryRoll" aria-label="Small select example">
                <option @if ($rollCount == 10) selected @endif value="10">10 rows</option>
                <option @if ($rollCount == 20) selected @endif value="20">20 rows</option>
                <option @if ($rollCount == 30) selected @endif value="30">30 rows</option>

            </select>
        </form>
    </div>



    {{-- table --}}
    <div class=" table-responsive my-5">
        @if (count($categories) == 0)
            <h1>empty category list</h1>
        @else
            <table class="table table-hover">
                <thead class=" table-primary">
                    <tr>
                        <th scope="col" class=" text-center">Action</th>
                        <th scope="col">No</th>
                        <th scope="col">Categories <i class="fa-solid fa-angle-down"></i></th>
                        <th scope="col">Publish <i class="fa-solid fa-angle-down"></i></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row" class=" d-flex justify-content-center">
                                {{-- edit --}}
                                <a href="{{ route('category#editPage', $category->category_id) }}"
                                    class="btn btn-success me-2">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                {{-- delete --}}
                                <a type="button" class="btn btn-danger ms-2" data-bs-toggle="modal"
                                    data-bs-target='#deleteModal{{ $category->category_id }}'>
                                    <i class="fa-solid fa-trash"></i>
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $category->category_id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $category->category_id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5"
                                                    id="deleteModalLabel{{ $category->category_id }}">Alert!</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Delete category {{ $category->name }} ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="{{ route('category#delete', ['id' => $category->category_id]) }}"
                                                    type="button" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <td>{{ $category->category_id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                {{-- switch --}}
                                <form action="{{ route('category#editFast', ['id' => $category->category_id]) }}"
                                    method="post" class="" id="switchForm{{ $category->category_id }}">
                                    @csrf
                                    <div class="form-check form-switch">
                                        <input class="form-check-input formSwitch" type="checkbox" role="switch"
                                            id="switch{{ $category->category_id }}" name="publishSwitch"
                                            @if ($category->status == 'publish') checked @endif
                                            onclick='switchForm{{ $category->category_id }}.submit()'>
                                    </div>

                                </form>

                            </td>
                        </tr>
                    @endforeach



                </tbody>
            </table>
        @endif
    </div>

    {{-- pagination --}}
    <div class="row">
        <div class=" d-flex justify-content-end">

            <div class="custom-pagination">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

@endsection
