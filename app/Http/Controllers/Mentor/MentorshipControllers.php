<?php

namespace App\Http\Controllers\Mentor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interface\MentorshipInterface;
use Illuminate\Support\Facades\Validator;
use App\Repositories\v_1\MentorshipRepositories;

class MentorshipControllers extends Controller implements MentorshipInterface
{
    use MentorshipRepositories;

    public function roomMentor(Request $request)
    {
        return $this->roomMentorRepositories($request);
    }

    public function listRoomMessage($idRoom, Request $request)
    {
        return $this->listRoomMessageRepositories($idRoom, $request);
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
}
