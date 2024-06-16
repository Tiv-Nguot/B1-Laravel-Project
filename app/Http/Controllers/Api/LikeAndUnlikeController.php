<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeAndUnlikeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = $request->user();
        try {
            $like = Like::where('user_id', $user->id)
                ->where('post_id', $request->post_id)
                ->first();

            if ($like) {
                $like->delete();
                return response()->json([
                    "data" => true,
                    "message" => "Like removed successfully"
                ]);
            } else {
                $like = new Like();
                $like->user_id = $user->id;
                $like->post_id = $request->post_id;

                if ($like->save()) {
                    return response()->json([
                        "data" => true,
                        "message" => "Like added successfully"
                    ]);
                } else {
                    return response()->json([
                        "data" => false,
                        "message" => "Something went wrong"
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                "data" => false,
                "message" => "Don't have post"
            ]);
        }
    }
}
