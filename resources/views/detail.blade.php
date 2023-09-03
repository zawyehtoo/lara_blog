@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h4>{{ $blog->title }}</h4>
                <p class="text-black-50">posted at {{ $blog->created_at->format('H: i | M y') }}</p>
                <p class="badge bg-black">{{ $blog->category->title }}</p>
                <p>{{ $blog->description }}</p>
                @include('layouts.comments')
            </div>
            <div class="col-4">
                @include('layouts.rightsidebar')
            </div>
        </div>
    </div>
@endsection
