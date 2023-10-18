<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface MenteeInterface
{
    public function listMentor(Request $request);
    public function sendChatRoom(Request $request);
    public function chatRoom($idRoom, Request $request);
}
