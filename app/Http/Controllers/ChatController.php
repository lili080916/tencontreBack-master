<?php
# @Author: Codeals
# @Date:   08-08-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 28-08-2019
# @Copyright: Codeals

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Vinkla\Pusher\Facades\Pusher as LaravelPusher;
// use Pusher\Laravel\Facades\Pusher;

use App\Events\ChatConversation;

class ChatController extends Controller
{

    public function getUserNotificationsChat(Request $request)
    {
        // $notifications = Chat::where('read', 0)
        //     // ->where('receiver_id', $request->user()->id)
        //     ->where('receiver_id', 1)
        //     ->groupBy('sender_id')
        //     ->orderBy('sender_id', 'desc')
        //     ->get();

        $notifications = DB::table('users')
            ->join('chats', 'chats.sender_id', '=', 'users.id')
            ->where('chats.read', '=', 0)
            ->where('receiver_id', $request->user()->id)
            ->select(array('users.*', DB::raw('COUNT(chats.sender_id) as quantity')))
            ->groupBy('users.name')
            ->orderBy('chats.created_at', 'desc')
            ->get();

        return response(['data' => $notifications], 200);
    }

    public function getUserConversationById (Request $request)
    {
        $userId = $request->input('id');
        $authUserId = $request->user()->id;
        $chats = Chat::whereIn('sender_id', [$authUserId,$userId])
            ->whereIn('receiver_id', [$authUserId,$userId])
            ->orderBy('created_at', 'desc')
            ->get();

        $chatsNoRead = Chat::where('sender_id', $userId)
            ->where('receiver_id', $authUserId)
            ->where('read', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        if (!$chatsNoRead->isEmpty()) {
            foreach ($chatsNoRead as $conversation) {
                $conversation->read = 1;
                $conversation->save();
            }
        }

        return response(['data' => $chats], 200);
    }

    public function clearNotificationChat (Request $request)
    {
        $userId = $request->input('id');
        $authUserId = $request->user()->id;

        $chatsNoRead = Chat::where('sender_id', $userId)
            ->where('receiver_id', $authUserId)
            ->where('read', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        if (!$chatsNoRead->isEmpty()) {
            foreach ($chatsNoRead as $conversation) {
                $conversation->read = 1;
                $conversation->save();
            }
        }

        return response(['data' => ['success' => true]], 201);
    }

    public function saveUserChat (Request $request)
    {
        $sender_id = $request->user()->id;
        $receiver_id = $request->input('receiver_id');
        $chatText = $request->input('chat');

        $data = [
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'chat' => $chatText,
            'read' => 0
        ];
        $chat = Chat::create($data);
        $finalData = Chat::where('id', $chat->id)->first();
        // LaravelPusher::trigger('chat_channel', 'chat_saved', ['message' => $finalData]);
        // Pusher::trigger('selfcars-staging', 'chat_saved', ['message' => $finalData->chat]);

        // event(new ChatConversation($chatText));

        // pusher
        event(new ChatConversation($finalData));

        return response(['data' => $finalData], 201);
    }
}
