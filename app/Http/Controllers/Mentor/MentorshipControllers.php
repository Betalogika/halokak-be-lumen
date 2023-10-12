<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\v_1\MentorshipRepositories;
use App\Interface\MentorshipInterface;
use Illuminate\Support\Facades\Validator;

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
}
