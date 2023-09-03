@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>Article List</h4>
                <hr>
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <a href="{{ route('blog.create') }}" class="btn btn-outline-dark">Create</a>
                <table class=" table">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Title</td>
                            @can('admin-only')
                                <td>Owner</td>
                            @endcan
                            <td>Category</td>
                            <td>Control</td>
                            <td>Created At</td>
                            <td>Updated At</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->title }}
                                    <br>
                                    <span
                                        class="small text-black-50">{{ Str::limit($article->description, 30, '...') }}</span>
                                </td>
                                @can('admin-only')
                                    <td>{{ $article->user->name ?? "Unknown" }}</td>
                                @endcan
                                <td>{{ $article->category->title ?? "Unknown" }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class=" btn btn-sm btn-outline-dark"
                                            href="{{ route('blog.show', $article->slug) }}">
                                            <i class="bi bi-info"></i>
                                        </a>
                                        @can('update', $article)
                                            <a href="{{ route('blog.edit', $article->id) }}"
                                                class="btn btn-sm btn-outline-dark">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endcan

                                        @can('delete', $article)
                                            <button form="deleteFrom{{ $article->id }}" class=" btn btn-sm btn-outline-dark">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        @endcan
                                    </div>
                                    <form id="deleteFrom{{ $article->id }}" class="delete-form d-inline-block"
                                        action="{{ route('blog.destroy', $article->id) }}" data-article-id="{{ $article->id }}" method="post">
                                        @method('delete')
                                        @csrf

                                    </form>
                                </td>
                                <td>
                                    <div class="d-block">
                                        <p class="small mb-0">
                                            <i class="bi bi-clock"></i>
                                            {{ $article->created_at->format('H:i a') }}
                                        </p>
                                        <p class="small mb-0">
                                            <i class="bi bi-calendar"></i>
                                            {{ $article->created_at->format('d M y') }}
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-block">
                                        <p class="small mb-0">
                                            <i class="bi bi-clock"></i>
                                            {{ $article->updated_at->format('H:i a') }}
                                        </p>
                                        <p class="small mb-0">
                                            <i class="bi bi-calendar"></i>
                                            {{ $article->updated_at->format('d M y') }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class=" text-center">
                                    <p>
                                        There is no record
                                    </p>
                                    <a class=" btn btn-sm btn-primary" href="{{ route('blog.create') }}">Create Article</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $articles->OnEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
    @vite(['resources/js/reply.js'])

@endsection
