<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface MenteeInterface
{
    public function listRoom(Request $request);
    public function listMentor(Request $request);
    public function chatMentor(Request $request);
    public function chatRoom($idRoom, Request $request);
}
