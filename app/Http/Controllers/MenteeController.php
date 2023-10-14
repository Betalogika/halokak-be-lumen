<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\v_1\MenteeRepositories;
use App\Interface\MenteeInterface;
use App\Models\Mentorship;

class MenteeController extends Controller implements MenteeInterface
{
    use MenteeRepositories;

    public function chatRoom($idRoom, Request $request)
    {
        if (!Mentorship::wherecode($idRoom)->first()) return $this->error('code room tidak di temukan');
        return $this->chatRoomRepositories($idRoom, $request);
    }

    public function sendChatRoom(Request $request)
    {
        return $this->sendChatRoomRepositories($request);
    }
}
