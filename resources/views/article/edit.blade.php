@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 ">
                <h4>Edit Article</h4>
                <hr>
                <form action="{{ route('blog.update', $blog->id) }}" id="updateForm" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                </form>
                    <div class="mb-3">
                        <label class=" form-label" for="">Article Title</label>
                        <input form="updateForm" type="text" class=" form-control @error('title') is-invalid @enderror"
                            value="{{ $blog->title }}" name="title">
                        @error('title')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class=" form-label" for="">Description</label>
                        <textarea form="updateForm" name="description" class=" form-control @error('description') is-invalid @enderror" rows="7">{{ $blog->description }}</textarea>
                        @error('description')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select form="updateForm" name="category" class="form-select">
                            @foreach (App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="mb-2 d-flex">

                            @forelse ($blog->photos as $photo)
                                <div class="position-relative me-2">
                                    <img src="{{ asset('storage/' . $photo->name) }}" height="100" width="100"
                                        class="rounded me-2" alt="">
                                    <form action="{{ route('photo.destroy', $photo->id) }}" class="d-inline-block "
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm position-absolute bottom-0 end-0">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <label for="photos" class="form-label">Photos</label>
                            <input form="updateForm" type="file"
                                class="form-control @error('photos')
                                is-invalid
                                @enderror
                            @error('photos.*')
                                is-invalid
                            @enderror"
                                name="photos[]" multiple>
                            @error('photos.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('photos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button form="updateForm" class=" btn btn-primary">Update blog</button>
            </div>
        </div>
    </div>
@endsection
