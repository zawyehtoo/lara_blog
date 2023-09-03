<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Photo;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Blog::when(request()->has("keyword"), function ($query) {
            $query->where(function (Builder $builder) {
                $keyword = request()->keyword;
                $builder->where("title", "like", "%" . $keyword . "%");
                $builder->orWhere("description", "like", "%" . $keyword . "%");
            });
        })
            ->when(Auth::user()->role != "admin", fn ($query) => $query->where("user_id", Auth::id()))
            ->when(request()->has('title'), function ($query) {
                $sortType = request()->title ?? 'asc';
                $query->orderBy("title", $sortType);
            })->with(['user','category'])
            ->latest('id')->paginate(7)->withQueryString();
            // return response()->json($articles);
        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $articles = new Blog();
        $articles->title = $request->title;
        $articles->slug = Str::slug($request->title);
        $articles->description = $request->description;
        $articles->category_id = $request->category;
        $articles->user_id = Auth::id();
        $articles->save();
        //saving photos
        foreach ($request->photos as $photo) {
            //save to storage
            $newName = uniqid() . "_blog_photo." . $photo->extension();
            $photo->storeAs("public", $newName);

            //save to db
            $photo = new Photo();
            $photo->blog_id = $articles->id;
            $photo->name = $newName;
            $photo->save();
        }
        return redirect()->route('blog.index')->with("message", $request->title . " is created");
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('article.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('article.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        Gate::authorize('update', $blog);
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->slug);
        $blog->description = $request->description;
        $blog->category_id = $request->category;
        $blog->update();
        //saving photos
        if(isset($request->photos)){
            foreach ($request->photos as $photo) {
                //save to storage
                $newName = uniqid() . "_blog_photo." . $photo->extension();
                $photo->storeAs("public", $newName);

                //save to db
                $photo = new Photo();
                $photo->blog_id = $blog->id;
                $photo->name = $newName;
                $photo->save();
            }
        }
        return redirect()->route("blog.index")->with("message", $request->title . " Update successful");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        Gate::authorize('delete', $blog);
        $blog->delete();
        foreach ($blog->photos as $photo) {
            //delete photo in storage
            Storage::delete("public/" . $photo->name);
            // delete photo in database
            $photo->delete();
        }
        return redirect()->back()->with("message", "Article Deleted successful");
    }
}
