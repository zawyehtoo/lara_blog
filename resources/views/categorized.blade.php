@extends('layouts.master')
@section('content')
    @if (request()->has('keyword') && $category->title)
        <p class="mb-1">Showing result by '{{ request()->keyword }}' and '{{ $category->title }}'</p>
    @elseif ($category->title)
        <div>
            <p class="mb-1">Showing result by '{{ $category->title }}'</p>
        </div>
    @endif
    @forelse ($articles as $article)
        <div class="card mb-3">
            <div class="card-body">
                <a href="" class="text-decoration-none text-dark">
                    <h3>{{ $article->title }}</h3>
                </a>
                <div>
                    <span class="badge bg-dark">{{ $article->category->title ?? 'Unknown' }}</span>
                    <span class="badge bg-dark">{{ $article->created_at->format('d M Y') ?? 'Unknown' }}</span>
                    <span class="badge bg-dark">{{ $article->user->name ?? 'Unknown' }}</span>
                </div>
                <p>{{ Str::words($article->description, 30, '....') }}</p>
                <a href="{{ route('detail', $article->slug) }}"><button class="btn btn-dark">See
                        More</button></a>
            </div>
        </div>
    @empty
    <div class="d-flex justify-content-center align-items-center" style="height:100%">
        <h1 class="text-danger">Sorry,no results for '{{ request()->keyword }}'</h1>
    </div>

    @endforelse
    <div>{{ $articles->onEachSide(1)->links() }}</div>
@endsection
