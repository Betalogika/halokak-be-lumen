<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\v_1\MenteeRepositories;
use App\Interface\MenteeInterface;
use App\Models\Mentorship;
use Illuminate\Support\Facades\Validator;

class MenteeController extends Controller implements MenteeInterface
{
    use MenteeRepositories;

    public function listMentor(Request $request)
    {
        return $this->listMentorRepositories($request);
    }

    public function chatRoom($idRoom, Request $request)
    {
        if (!Mentorship::wherecode($idRoom)->first()) return $this->error('code room tidak di temukan');
        return $this->chatRoomRepositories($idRoom, $request);
    }

    public function chatmentor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mentor_user_id' => 'int|required',
            'message' => 'string|required',
        ]);

        if ($validator->fails()) {
            $result = $this->customError($validator->errors());
        } else {
            $result = $this->sendChatMentorRepositories($request);
        }

        return $result;
    }
}
