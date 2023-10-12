<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface MentorshipInterface
{
    public function room(Request $request);
    public function createRoom(Request $request);
    public function sendMessageRoom(Request $request);
}
