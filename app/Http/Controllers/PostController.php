<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view(
            'posts.index',
            [
                'categories' => Category::all(),
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

    public function create()
    {
        return view('posts.create');
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'required',
            'slug' => 'required',
            'body' => 'required',
        ]);

        $post = new Post;

        $post->user_id = auth()->user()->id;
        $post->title = $request->title;
        $post->sub_title = $request->subtitle;
        $post->slug = $request->slug;
        $post->image = auth()->user()->role;
        $post->body = $request->body;
        $post->published_at = Carbon::now()->toDateTimeString();

        if(auth()->user()->role != 'ADMIN'){
            $post->status = 0;
        }
      
        $post->save();
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
