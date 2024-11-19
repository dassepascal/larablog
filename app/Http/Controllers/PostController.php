<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Cache\Store;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->latest()->get();
       
       return view('posts.index',[
        'posts' => $posts,
        
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create',[
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $imageName = $request->image->store('posts');

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
            
        ]);
        return redirect()->route('dashboard')->with('success', 'Votre post a été créé');
             
    
        
    }
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show',[
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if( Gate::denies('update-post', $post))
        {
            abort(403);
        }
        $categories = Category::all();
        return view('posts.edit',[
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $arrayUpdate = [
            'title' => $request->title,
            'content' => $request->content
        ];

        if($request->image !== null)
        {
            $imageName = $request->image->store('posts');
            $arrayUpdate = array_merge($arrayUpdate,[
                'image'=>$imageName
            ]);
        }

        $post->update($arrayUpdate);

        return redirect()->route('dashboard')->with('success', 'Votre post a été modifié');
           
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if( Gate::denies('destroy-post', $post))
        {
            abort(403);
        }
        $post->delete();
        return redirect()->route('dashboard')->with('success', 'Votre post a été supprimé');
        
    }
}
