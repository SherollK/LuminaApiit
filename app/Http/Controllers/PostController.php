<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categoryIds = $user->categories->pluck('id');
        $posts = Post::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('categories.id', $categoryIds);
        })->get();
        return view('posts.index',
            [
                'categories' => Category::all(),
                'posts' => $posts,
            ]
        );
        
    }

    public function show(Post $post)
    {
        return view(
            'posts.show',
            [
                'post' => $post
            ]
        );
    }

    public function store(Request $request)
    {
        //   'user_id',
        // 'title',
        // 'sub_title',
        // 'slug',
        // 'image',
        // 'body',
        // 'published_at',
        // 'featured',

        // $post = new Post(); 
        // $post->title = $request->title;
        // $post->sub_title = $request->sub_title;
        // $post->slug = Str::slug($post->title);

        // $post->save();
        // return redirect()->route('posts.show', $post->id);



    }

    public function create()
    {
        return view('posts.create')
        ;
    }
}