<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',Category::class);
        $categories=Category::with('user')->latest()->get();
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->authorize('create',Category::class);
        $category=Category::create([
            "title"=>$request->title,
            "slug"=>Str::slug($request->slug),
            "user_id"=>Auth::id()
        ]);
        return redirect()->route('category.index')->with("message",$request->title." is created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
       $this->authorize('update',$category);
        return view('category.edit',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $this->authorize('update',$category);
        // if($request->user()->cannot('update',$category)){
        //     return abort(403,"sorry");
        // }
        $category->slug=Str::slug($request->slug);
        $category->title = $request->title;
        $category->update();

        return redirect()->route("category.index")->with("message",$request->title. " Update successful");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete',$category);
        $category->delete();
        return redirect()->back()->with("message", "Category deleted successful");
    }
}
