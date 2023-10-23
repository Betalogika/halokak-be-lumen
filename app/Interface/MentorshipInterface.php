<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface MentorshipInterface
{
    public function roomMentor(Request $request);
    public function listRoomMessage($idRoomm, Request $request);
    public function sendMessageRoom(Request $request);
}
