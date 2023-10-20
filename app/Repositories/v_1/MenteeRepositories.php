<?php

namespace App\Repositories\v_1;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Mentorship;
use App\Models\MessageRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MessageRoomMentee;
use App\Models\User as Mentor;

trait MenteeRepositories
{
    public function response()
    {
        return new Controller;
    }

    public function listMentorRepositories($request)
    {
        return Mentor::where('role_id', '=', 7)
            ->when($request->username, function ($query) use ($request) {
                return $query->where('username', 'like', "%{$request->username}%");
            })
            ->with('profile')
            ->orderByDesc('id')
            ->paginate($this->response()->pagination($request));
    }

    public function chatRoomRepositories($idRoom, $request)
    {
        $data = MessageRoom::wherecode($idRoom)
            ->when($request->message, function ($query) use ($request) {
                return $query->where('message', 'like', "%{$request->message}%");
            })
            ->orderByDesc('_id')
            ->paginate($this->response()->pagination($request));

        return $data;
    }

    public function sendChatRoomRepositories($request)
    {
        DB::beginTransaction();
        try {
            $submitMessage = $request->only('code', 'mentee_user_id', 'message');
            if (!Mentorship::wherecode($request->code)->first()) return $this->response()->error('code room tidak di temukan');
            if (!$profile = Profile::whereusers_id(Auth::guard('user')->user()->id)->first()) {
                return $this->response()->error('profile belum ada');
            } else {
                $submitMessage['mentee_user_id'] = array(
                    'id' => Auth::guard('user')->user()->id,
                    'nama' => $profile->nama_lengkap,
                    'photo' => $profile->photo,
                );
            }
            MessageRoomMentee::create($submitMessage);
            DB::commit();
            return $this->response()->ok($submitMessage, 'berhasil kirim message');
        } catch (\Exception $error) {
            DB::rollBack();
            return $this->response()->error($error);
        }
    }
}
