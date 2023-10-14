<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface MenteeInterface
{
    public function chatRoom(Request $request);
}
