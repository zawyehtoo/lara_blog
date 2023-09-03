@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>{{ $blog->title }}</h4>
                <p class="text-black-50">posted at {{ $blog->created_at->format('H: i | M y') }}</p>
                <p class="badge bg-black">{{ $blog->category->title }}</p>
                <p>{{ $blog->description }}</p>
                <ul class="list-group">

                </ul>
                @forelse ($blog->photos as $photo)
                    <img src="{{ asset('storage/' . $photo->name) }}" height="100" alt="">
                @empty
                @endforelse
            </div>
        </div>
    </div>
  
@endsection
