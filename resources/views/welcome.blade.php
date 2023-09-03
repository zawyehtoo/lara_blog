@extends('layouts.master')
@section('content')
    @if (request()->has('keyword'))
        <p>Showing result by '{{ request()->keyword }}'</p>
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
        <div class="d-flex justify-content-center align-items-center" style="height:150%">
            <h3 class="text-danger">Sorry,no results for <span class="badge bg-dark">'{{ request()->keyword }}'</span></h3>
        </div>

    @endforelse
    <div>{{ $articles->onEachSide(1)->links() }}</div>
@endsection
