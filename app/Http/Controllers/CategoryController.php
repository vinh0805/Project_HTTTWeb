<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPet;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function showPostOfCategoryPet($categoryPetName, $categoryName)
    {
        $categoryPet = CategoryPet::where('name', $categoryPetName)->first();
        $category = Category::where('name', $categoryName)->first();
        $i = 0;
        if(isset($categoryPet) && isset($category)){
            $allPosts = DB::table('posts')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.*', 'users.name', 'users.avatar')
                ->where('category_pet_id', $categoryPet->id)
                ->where('category_id', $category->id)
                ->where('status', 1)->get();
            return view('categories.screen08-pet-category')
                ->with('allPosts', $allPosts)->with('categoryPet', $categoryPet)
                ->with('category', $category);
        }
        return 0;
    }
}
