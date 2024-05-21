<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if(!$user)
        {
            $posts = Post::all();
            return view('posts.index',
            [
                'categories' => Category::all(),
                'posts' => $posts,
            ]
        );
            
        }

        else {
            $categoryIds = $user->categories->pluck('id');
            $posts = Post::whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            })
            ->visible()
            ->get();

            return view('posts.index',
            [
                'categories' => Category::all(),
                'posts' => $posts,
            ]
        );
        }
        
       

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

    public function visibility(): bool
    {
        $user = Auth::user();

        // Check if the author has the role of ROLE_ALUMINI or CONTENT_MNG
        if ($user->role == "ROLE_ALUMINI" || $user->role == "CONTENT_MNG") {
            // If the user is an alumnus or content manager, get the value of hide
            $hide = $user->hide;

            // Return false if hide is true, indicating that the post should be hidden
            return !$hide;
        }

        // If the user does not have the specified roles, the post should be visible
        return true;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
