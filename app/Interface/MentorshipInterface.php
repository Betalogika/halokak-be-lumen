<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface MentorshipInterface
{
    public function listRoomMessage(Request $request);
    public function sendMessageRoom(Request $request);
}
