@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('category.store') }}" method="post">

                    @csrf

                    <div class="mb-3">
                        <label class=" form-label" for="">Category Title</label>
                        <input type="text" class=" form-control @error('title') is-invalid @enderror" name="title" value="{{old('title')}}">
                        @error('title')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <button class=" btn btn-primary">Save Category</button>
                </form>
            </div>
        </div>
    </div>
@endsection
