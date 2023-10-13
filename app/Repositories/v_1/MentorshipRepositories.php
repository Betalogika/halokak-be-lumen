<?php

namespace App\Repositories\v_1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Mentorship;
use App\Models\MessageRoom;
use App\Models\Profile;
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
        $data = Mentorship::where('mentor_user_id.id', Auth::guard('mentor')->user()->id)
            ->when($request->code, function ($query) use ($request) {
                return $query->where('code', 'like', "%{$request->code}%");
            })->when($request->title, function ($query) use ($request) {
                return $query->where('title', 'like', "%{$request->title}%");
            })->when($request->desc, function ($query) use ($request) {
                return $query->where('desc', 'like', "%{$request->desc}%");
            })
            ->orderByDesc('_id')
            ->paginate($limit);
        return $data;
    }

    public function createRoomRepostiories($request)
    {
        try {
            $submitRoom = $request->only('title', 'code', 'desc', 'mentor_user_id', 'status');
            $submitRoom['code'] = $this->codeRoom();
            $submitRoom['mentor_user_id'] = array(
                'id' => Auth::guard('mentor')->user()->id,
                'nama' => Profile::whereusers_id(Auth::guard('mentor')->user()->id)->first()->nama_lengkap,
                'photo' =>  Profile::whereusers_id(Auth::guard('mentor')->user()->id)->first()->photo,
            );
            Mentorship::create($submitRoom);
            return $this->response()->ok($submitRoom, 'Successfully Create Room');
        } catch (\Exception $error) {
            return $this->response()->error($error);
        }
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
