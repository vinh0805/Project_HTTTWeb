<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPet;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function authLogin()
    {
        if (Session::get('sUser')) {
            return redirect('me');
        } else {
            return redirect('login')->send();
        }
    }

    public function isAdmin()
    {
        $this->authLogin();
        $user = Session::get('sUser');
        if (isset($user->role)) {
            if ($user->role == 1)
                return 1;
        }
        return 0;
    }

    public function showPostsHomePage()
    {
        $allCategoryPet = CategoryPet::all();
        $allCategory = Category::all();
        $countPost = [];
        $newestPostList = [];
        $i = 0;
        foreach ($allCategoryPet as $categoryPet) {
            foreach ($allCategory as $category) {
                $countPost[$i] = count(Post::where('category_pet_id', '=', $categoryPet->id)
                    ->where('category_id', '=', $category->id)->where('status', '=', 1)->get());
                $newestPostList[$i] = Post::where('category_pet_id', '=', $categoryPet->id)
                    ->where('category_id', '=', $category->id)->where('status', '=', 1)
                    ->orderBy('created_at', 'desc')->first();
                $i++;
            }
        }

        return view('screen04-home-page')->with('allCategoryPet', $allCategoryPet)
            ->with('allCategory', $allCategory)
            ->with('countPost', $countPost)
            ->with('newestPostList', $newestPostList);
    }

    public function createPost()
    {
        $this->authLogin();
        $allCategoryPet = CategoryPet::all();
        $allCategory = Category::all();
        return view('posts.screen18-create-post')->with('allCategoryPet', $allCategoryPet)
            ->with('allCategory', $allCategory);
    }

    public function savePost(Request $request)
    {
        $this->authLogin();
        $data = $request->all();
        $newPost = new Post([
            'user_id' => Session::get('sUser')->id,
            'title' => $data['postTitle'],
            'category_pet_id' => $data['postCategoryPet'],
            'category_id' => $data['postCategory'],
            'content' => $data['postContent'],
            'status' => 1
        ]);
        $newPost->save();
        $currentPost = Post::orderBy('id', 'desc')->first();
        return redirect('post/' . $currentPost->id);
    }

    public function showPost($postId)
    {
        $post = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name', 'users.avatar')
            ->where('posts.id', '=', $postId)->first();
        if(!isset($post)){
            echo "Have bug!!!";
        } else {
            return view('posts.screen13-show-post')->with('post', $post);
        }
        return 0;
    }

    public function search(Request $request){
        if($request->ajax()) {
            if ($request['title'] == '' || $request['title'] == null) {
                $output = '';
            } else {
                $posts = Post::where('title', 'LIKE', '%'.$request['title'].'%')
                    ->where('status', '=', '1')->get();
                $output = '';

                if (count($posts) > 0) {
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                    foreach ($posts as $post){
                        $output .= '<li class="list-group-item"><a href="post/' . $post->id . '">'.$post->title.'</a></li>';
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<li class="list-group-item">'.'No results'.'</li>';
                }
            }
            return $output;
        }
    }
}
