<?php

// FriendController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Friend\RemoveFriendRequest;
use App\Http\Resources\Friend\FriendResource;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function listFriends()
    {
        $user = User::find(Auth::id());
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }
        $friends = $user->friends()->get();
        // Append friendsOf relationship
        $friendsOf = $user->friendsOf()->get();
        // Merge friends and friendsOf into a single collection
        $allFriends = $friends->merge($friendsOf);
        // Convert collection to array and remove duplicates
        $uniqueFriends = $allFriends->unique('id')->values()->all();
        $uniqueFriends = FriendResource::collection($uniqueFriends);
        if (empty($uniqueFriends)) {
            return response()->json([
                'Currently User' => $user->name,
                'Total Friends' => 0,
                'message' => 'You have no friends yet.'
            ]);
        }
        $uniqueFriends = FriendResource::collection($uniqueFriends);
        return response()->json([
            'Currently User' => $user->name,
            'Total Friends' => count($uniqueFriends),
            'data' => $uniqueFriends
        ]);
    }
    public function removeFriend(RemoveFriendRequest $request)
    {
        $friend = Friend::where(function ($query) use ($request) {
            $query->where('user_id1', Auth::id())
                ->where('user_id2', $request->friend_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('user_id1', $request->friend_id)
                ->where('user_id2', Auth::id());
        })->first();

        if ($friend) {
            $friend->delete();
            return response()->json(['message' => 'Friend removed successfully']);
        }
        return response()->json(['message' => 'Friend not found'], 404);
    }
}
