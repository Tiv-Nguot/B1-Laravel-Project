<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function adminListPosts()
    {
        $posts = Post::all();
        return $posts;
    }

    public function userListPosts()
    {
        $posts = Post::list();
        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Post::create([
            'image_url' => $request->image_url,
            'description' => $request->description,
            'user_id' => Auth()->user()->id,
        ]);
        return response()->json([
            "data" => true,
            "message" => "Post created successfully"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function adminUpdate(Request $request, string $id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->update($request->all());
            return response()->json([
                "data" => true,
                "message" => "Admin post updated successfully"
            ]);
        }
        return response()->json([
            "data" => false,
            "message" => "Post not found"
        ], 404);
    }
    public function userUpdate(Request $request, string $id)
    {
        $post = Post::userUpdate($id);
        if ($post) {
            $post->update($request->all());
            return response()->json([
                "data" => true,
                "message" => "User post updated successfully"
            ]);
        }
        return response()->json([
            "data" => false,
            "message" => "Post not found"
        ], 404);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function adminDestroy(string $id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return response()->json([
                "data" => true,
                "message" => "Post admin deleted successfully"
            ]);
        }
        return response()->json([
            "data" => false,
            "message" => "Post admin deleted successfully"
        ], 404);
    }

    public function userDestroy(string $id)
    {
        $user = Post::userDelete($id);
        if ($user) {
            if ($user) {
                $user->delete($id);
                return response()->json([
                    "data" => true,
                    "message" => "User user deleted successfully"
                ]);
            }
            return response()->json([
                "data" => false,
                "message" => "You do not have permission to delete this post"
            ], 403); 
        }
        return response()->json([
            "data" => false,
            "message" => "Post not found"
        ], 404);
    }
}
