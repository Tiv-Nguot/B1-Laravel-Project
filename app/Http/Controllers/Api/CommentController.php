<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentCreateRequest;
use App\Http\Requests\Comment\CommentUpdateRequest;
use App\Http\Resources\CommentResources;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::list();
        foreach ($comments as $comment) {
            if ($comments) {
                $comment = CommentResources::collection($comments);
                return response()->json(['success' => true, 'data' => $comment], 200);
            }
        }
        return response()->json(['success' => false, 'Message' => "The comment are empty"], 404);
    }

    /**
     * Store a newly created resource in storage.   
     */
    public function store(CommentCreateRequest $request)
    {

        $comment = Comment::create([
            'title' => $request->title,
            'image' => $request->image,
            'user_id' => Auth()->user()->id,
            'post_id' => Auth()->user()->id,
            'like_id' => Auth()->user()->id,
        ]);
        return response()->json(['success' => true, 'data' => $comment], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['success' => false, 'Message' => "Not found comment id $id "], 404);
        }
        return response()->json(['success' => true, 'data' => $comment], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentUpdateRequest $request, string $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['success' => false, 'Message' => "Not found comment id $id "], 404);
        }
        $comment->update($request->all());
        return response()->json(['success' => true, 'data' => $comment], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['success' => false, 'Message' => "Not found comment id $id "], 404);
        }
        $comment->delete();
        return response()->json(['success' => true, 'Message' => "Deleted comment successfully Id $id"], 200);
    }
}
