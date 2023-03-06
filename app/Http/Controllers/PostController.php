<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    private $defaultPerPage = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->orderByDesc('created_at')->paginate($this->defaultPerPage);
        $header = ['title' => 'Posts'];
        return view('posts.index', compact('posts', 'header'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header = ['title' => 'Create Post', 'action' => 'posts.store'];
        $post = new Post;
        return view('posts.create-edit', compact('header', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $validatedData)
    {
        $post = new Post;
        $post->title = $validatedData['title'];
        $post->description = $validatedData['description'];
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comments = $post->comments()->with('user')->get();
        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $header = ['title' => 'Edit Post'];
        if ($post->user_id != auth()->user()->id) {
            return redirect()->route('posts.index');
        }
        return view('posts.create-edit', compact('post', 'header'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $validatedData, Post $post)
    {
        $post->title = $validatedData['title'];
        $post->description = $validatedData['description'];
        $post->save();
        if ($post->user_id != auth()->user()->id) {
            return redirect()->route('posts.index');
        }
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        if ($post->user_id != auth()->user()->id) {
            return redirect()->route('posts.index');
        }
        return redirect()->route('posts.index');
    }

    public function myPosts()
    {
        $user = Auth::user();
        $posts = $user->posts()->with('user')->orderByDesc('created_at')->paginate($this->defaultPerPage);
        $header = ['title' => 'My Posts'];
        return view('posts.index', compact('posts', 'header'));
    }
}
