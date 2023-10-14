<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\v_1\MenteeRepositories;
use App\Interface\MenteeInterface;

class MenteeController extends Controller implements MenteeInterface
{
    use MenteeRepositories;

    public function chatRoom(Request $request)
    {
        return $this->chatRoomRepositories($request);
    }
}
