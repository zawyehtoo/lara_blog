@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>Category List</h4>
                <hr>
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <a href="{{ route('category.create') }}" class="btn btn-outline-dark">Create</a>
                <table class=" table">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Title</td>
                            <td>Owner</td>
                            <td>count</td>
                            <td>Control</td>
                            <td>Created At</td>
                            <td>Updated At</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->user->name  }}</td>
                                <td>{{$category->blogs()->count()}}</td>
                                <td>
                                    <div class="btn-group">
                                        @can('view', $category)
                                            <a class=" btn btn-sm btn-outline-dark"
                                                href="{{ route('category.show', $category->id) }}">
                                                <i class="bi bi-info"></i>
                                            </a>
                                        @endcan

                                        @can('update', $category)
                                            <a href="{{ route('category.edit', $category->id) }}"
                                                class="btn btn-sm btn-outline-dark">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endcan

                                        @can('delete', $category)
                                            <button form="deleteFrom{{ $category->id }}" class=" btn btn-sm btn-outline-dark">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        @endcan

                                    </div>
                                    <form id="deleteFrom{{ $category->id }}" class=" d-inline-block"
                                        action="{{ route('category.destroy', $category->id) }}" method="post">
                                        @method('delete')
                                        @csrf

                                    </form>
                                </td>
                                <td>
                                    <div class="d-block">
                                        <p class="small mb-0">
                                            <i class="bi bi-clock"></i>
                                            {{ $category->created_at->format('H:i a') }}
                                        </p>
                                        <p class="small mb-0">
                                            <i class="bi bi-calendar"></i>
                                            {{ $category->created_at->format('d M y') }}
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-block">
                                        <p class="small mb-0">
                                            <i class="bi bi-clock"></i>
                                            {{ $category->updated_at->format('H:i a') }}
                                        </p>
                                        <p class="small mb-0">
                                            <i class="bi bi-calendar"></i>
                                            {{ $category->updated_at->format('d M y') }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class=" text-center">
                                    <p>
                                        There is no record
                                    </p>
                                    <a class=" btn btn-sm btn-primary" href="{{ route('category.create') }}">Create
                                        Category</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{-- {{$categories->OnEachSide(1)->links()}} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
