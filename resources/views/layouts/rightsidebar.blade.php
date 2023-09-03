<div class="position-sticky" style="top: 80px">
    <div class="search-form mb-4">
        <p class="mb-2">Article Search</p>
        <form action="" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" value="{{ request()->keyword }}">
                <button class="btn btn-dark">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>
    <div class="categories mb-4">
        <p class="mb-2">Categories</p>
        <div class="list-group">
            @foreach (App\Models\Category::all() as $category)
                <a href="{{route('categorized',$category->slug)}}" class="list-group-item list-group-item-action">{{ $category->title }}</a>
            @endforeach
        </div>
    </div>

</div>
