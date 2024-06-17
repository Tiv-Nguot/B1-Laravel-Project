<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Permission;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminListUsers(Request $request)
    {
        $admin = $request->user()->id;
        if ($admin == 1) {
            $users = User::where('id', '!=', 1)->get();
            return response()->json([
                'success' => true,
                'total' => $users->count(),
                'users' => $users
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'You do not have permission to access this resource'
        ], 403);
    }
    // list posts
    public function adminListPosts(Request $request)
    {
        $admin = $request->user()->id;
        if ($admin == 1) {
            $posts = Post::all();
            return response()->json([
                'success' => true,
                'total' => $posts->count(),
                'posts' => $posts
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'You do not have permission to access this resource'
        ], 403);
    }
    public function deleteUser(Request $request, $id)
    {
        $admin = $request->user()->id;
        if ($admin == 1) {
            $user = User::find($id);
            if ($user && $user->id != 1) {
                $user->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'User deleted successfully'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }
        return response()->json([
            'success' => false,
            'message' => 'You do not have permission to access this resource'
        ], 403);
    }
    public function deletePost(Request $request, $id)
    {
        $admin = $request->user()->id;
        if ($admin == 1) {
            $post = Post::find($id);
            if ($post) {
                $post->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Post deleted successfully'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }
        return response()->json([
            'message' => 'You do not have permission to access this resource'
        ], 403);
    }
}
