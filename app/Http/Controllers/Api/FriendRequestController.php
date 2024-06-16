<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Friend\AcceptFriendRequest;
use App\Http\Requests\Friend\AddFriendRequest;
use App\Http\Resources\Friend\ListRequestPaddingResource;
use App\Models\FriendRequest;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendRequestController extends Controller
{
    public function addFriendRequest(AddFriendRequest $request)
    {
        if ($request->receiver_id == Auth::id()) {
            return response()->json(['message' => 'You cannot send a friend request to yourself'], 400);
        }
        // Check if a friend request already exists
        $existingRequest = FriendRequest::where('requester_id', Auth::id())
            ->where('receiver_id', $request->receiver_id)
            ->first();
        if ($existingRequest) {
            return response()->json(['message' => 'You have already sent a friend request to this user'], 400);
        }
        FriendRequest::create([
            'requester_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
        ]);
        return response()->json(['message' => 'Friend request sent successfully']);
    }

    public function respondToFriendRequest(AcceptFriendRequest $request)
    {
        $friendRequest = FriendRequest::findOrFail($request->requester_id);
        if ($friendRequest->receiver_id != Auth::id()) {
            return response()->json(['message' => "This user with id {$friendRequest->requester_id} hasn't added you"], 403);
        }
        if ($friendRequest->status_id == 3) {
            return response()->json(['message' => 'This friend request has already been canceled'], 400);
        }
        if ($friendRequest->status_id == 2) {
            return response()->json(['message' => 'This friend request has already been accepted'], 400);
        }
        if ($request->status_id == 2) {
            Friend::create([
                'user_id1' => $friendRequest->requester_id,
                'user_id2' => $friendRequest->receiver_id,
            ]);
        }
        // Update the status of the friend request
        $friendRequest->status_id = $request->status_id;
        $friendRequest->save();
        $message = ($request->status_id == 2) ? 'Friend request accepted successfully' : 'Friend request canceled successfully';
        return response()->json(['message' => $message]);
    }

    //list all received friend requests
    public function listRequesters()
    {
        $receiver = Auth::user();
        $friendRequests = FriendRequest::where('receiver_id', $receiver->id)
            ->where('status_id', 1)
            ->get();
        if ($friendRequests->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No friend requests found']);
        }
        $friendRequests = ListRequestPaddingResource::collection($friendRequests);
        return response()->json([
            'message' => 'Get all requesters add you as a friend successfully',
            'data' => [
                'receiver_id' => $receiver->id,
                'receiver_name' => $receiver->name,
                'requester_total' => $friendRequests->count(),
                'requesters' => $friendRequests,
            ],
        ]);
    }
}
