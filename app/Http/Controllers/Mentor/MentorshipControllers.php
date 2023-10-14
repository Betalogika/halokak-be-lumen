<?php

namespace App\Http\Controllers\Mentor;

use App\Models\Mentorship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interface\MentorshipInterface;
use Illuminate\Support\Facades\Validator;
use App\Repositories\v_1\MentorshipRepositories;

class MentorshipControllers extends Controller implements MentorshipInterface
{
    use MentorshipRepositories;

    public function room(Request $request)
    {
        return $this->RoomRepositories($request);
    }

    public function createRoom(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'string|required',
            'desc' => 'string|required',
        ]);

        if ($validate->fails()) {
            $result = $this->customError($validate->errors());
        } else {
            $result = $this->createRoomRepostiories($request);
        }

        return $result;
    }

    public function sendMessageRoom(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'code' => 'required',
            'message' => 'required',
        ]);

        if ($validate->fails()) {
            $result = $this->customError($validate->errors());
        } else {
            $result = $this->sendMessageRoomRepostiories($request);
        }

        return $result;
    }

    public function chatRoom($idRoom, Request $request)
    {
        if (!Mentorship::wherecode($idRoom)->first()) return $this->error('code room tidak di temukan');
        return $this->chatRoomRepositories($idRoom, $request);
    }
}
