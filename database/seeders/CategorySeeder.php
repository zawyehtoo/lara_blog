<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories=["Local news","International News","Sports","Travel","Foods"];
        $arr=[];
        foreach($categories as $category){
            $arr[]=[
                "title"=>$category,
                "slug"=>Str::slug($category),
                "user_id"=>11,
                "created_at"=>now(),
                "updated_at"=>now()
            ];
        }
        Category::insert($arr);
    }
}
