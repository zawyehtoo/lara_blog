@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>Edit Category</h4>
                <hr>
                <form action="{{ route('category.update', $category->id) }}" method="post">
                    @method('put')
                    @csrf

                    <div class="mb-3">
                        <label class=" form-label" for="">Category Title</label>
                        <input type="text" class=" form-control" value="{{ $category->title }}" name="title">
                    </div>



                    <button class=" btn btn-primary update-btn">Update category</button>
                </form>
            </div>
        </div>
    </div>
    @vite(['resources/js/reply.js'])

@endsection

