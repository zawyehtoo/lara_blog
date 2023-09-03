<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class PageController extends Controller
{
    public function index()
    {
        $articles=Blog::when(request()->has("keyword"),function($query){
            $keyword = request()->keyword;
            $query->where("title","like","%".$keyword."%");
            $query->orWhere("description","like","%".$keyword."%");
        })
        ->when(request()->has('category'),function($query){
            $query->where('category_id',request()->category);
        })
        ->when(request()->has('title'),function($query){
            $sortType = request()->title ?? 'asc';
            $query->orderBy("title",$sortType);
        })
        ->paginate(10)->withQueryString();

        return view('welcome',compact('articles'));
    }
    public function categorized($slug){
        $category=Category::where('slug',$slug)->firstOrFail();
        return view('categorized',[
            'category'=>$category,
            'articles'=>$category->blogs()->when(request()->has("keyword"),function($query){
                $keyword = request()->keyword;
                $query->where("title","like","%".$keyword."%");
                $query->orWhere("description","like","%".$keyword."%");
            })->paginate(5)->withQueryString()
        ]);
    }
    public function detail($slug){
        $blog=Blog::where('slug',$slug)->firstOrFail();
        return view('detail',compact('blog'));
    }
}

