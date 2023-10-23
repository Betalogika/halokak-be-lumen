<?php

namespace App\Repositories\v_1;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use App\Models\MessageRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait MentorshipRepositories
{
    public function response()
    {
        return new Controller;
    }

    public function roomMentorRepositories($request)
    {
        return Mentorship::where('mentor.id', '=', Auth::guard('mentor')->user()->id)
            ->when($request->code, function ($query) use ($request) {
                return $query->where('code', 'like', "%{$request->code}%");
            })->when($request->title, function ($query) use ($request) {
                return $query->where('title', 'like', "%{$request->title}%");
            })->when($request->desc, function ($query) use ($request) {
                return $query->where('desc', 'like', "%{$request->desc}%");
            })->when($request->status, function ($query) use ($request) {
                return $query->where('status', 'like', "%{$request->status}%");
            })
            ->orderByDesc('_id')
            ->paginate($this->response()->pagination($request));
    }

    public function listRoomMessageRepositories($idRoom, $request)
    {
        if (!$message = Mentorship::where([
            ['mentor.id', '=', Auth::guard('mentor')->user()->id],
            ['code', $idRoom]
        ])->first()) {
            $result = $this->response()->error('code room tidak ditemukan');
        } else {
            $result = MessageRoom::wherecode($message->code)
                ->when($request->code, function ($query) use ($request) {
                    return $query->where('code', 'like', "%{$request->code}%");
                })->orderByDesc('_id')
                ->paginate($this->response()->pagination($request));

            return $result;
        }

        return $result;
    }


    public function sendMessageRoomRepostiories($request)
    {
        DB::beginTransaction();
        try {
            $submitMessage = $request->only('code', 'mentor', 'message');
            if (Mentorship::where([
                ['mentor.id', '=', Auth::guard('mentor')->user()->id],
                ['code', $submitMessage['code']]
            ])->first()) {
                if (!Mentorship::wherecode($request->code)->first()) return $this->response()->error('code room tidak di temukan');
                $submitMessage['mentor'] = array(
                    'id' => Auth::guard('mentor')->user()->id,
                    'nama' => Auth::guard('mentor')->user()->username,
                );
                MessageRoom::create($submitMessage);
                DB::commit();
            } else {
                return $this->response()->error('code room tidak ditemukan');
            }
            return $this->response()->ok($submitMessage, 'berhasil kirim message');
        } catch (\Exception $error) {
            DB::rollBack();
            return $this->response()->error($error);
        }
    }
}
