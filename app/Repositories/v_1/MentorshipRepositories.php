<?php

namespace App\Repositories\v_1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Mentorship;
use App\Models\MessageRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait MentorshipRepositories
{
    public function response()
    {
        return new Controller;
    }

    private static function codeRoom()
    {
        $xCode = Str::random(3);
        $yCode = Str::random(4);
        $zCode = Str::random(3);
        $codeRoom = "{$xCode}-{$yCode}-{$zCode}";
        return $codeRoom;
    }

    public function RoomRepositories($request)
    {
        $limit = 50;
        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }
        $data = Mentorship::whereusers_id(Auth::guard('mentor')->user()->id)
            ->when($request->code, function ($query) use ($request) {
                return $query->where('code', 'like', "%{$request->code}%");
            })->when($request->title, function ($query) use ($request) {
                return $query->where('title', 'like', "%{$request->title}%");
            })->when($request->desc, function ($query) use ($request) {
                return $query->where('desc', 'like', "%{$request->desc}%");
            })
            ->orderByDesc('_id')
            ->paginate($limit);
        return RoomResource::collection($data);
    }

    public function createRoomRepostiories($request)
    {
        $submitRoom = $request->only('title', 'code', 'desc', 'users_id');
        $submitRoom['code'] = $this->codeRoom();
        $submitRoom['users_id'] = Auth::guard('mentor')->user()->id;
        Mentorship::create($submitRoom);
        return $this->response()->ok($submitRoom, 'Successfully Create Room');
    }

    public function sendMessageRoomRepostiories($request)
    {
        DB::beginTransaction();
        try {
            $submitMessage = $request->only('code', 'users_id', 'message');
            if (!Mentorship::wherecode($request->code)->first()) return $this->response()->error('code room tidak di temukan');
            $submitMessage['users_id'] = Auth::guard('mentor')->user()->id;
            MessageRoom::create($submitMessage);
            DB::commit();
            return $this->response()->ok($submitMessage, 'berhasil kirim message');
        } catch (\Exception $error) {
            DB::rollBack();
            return $this->response()->error($error);
        }
    }
}
