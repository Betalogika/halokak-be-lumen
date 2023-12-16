<?php

namespace App\Repositories\v_1;

use App\Models\Profile;
use App\Models\Mentorship;
use App\Models\MessageRoom;
use Illuminate\Support\Str;
use App\Models\User as Mentor;
use App\Models\MessageRoomMentee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

trait MenteeRepositories
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

    public function listRoomRepositories($request)
    {
        return Mentorship::where('mentee.id', '=', Auth::guard('user')->user()->id)
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
        if (Mentorship::where([
            ['mentee.id', '=', Auth::guard('user')->user()->id],
            ['code', $idRoom]
        ])->first()) {
            $data = MessageRoom::where('code', $idRoom)
                ->when($request->message, function ($query) use ($request) {
                    return $query->where('message', 'like', "%{$request->message}%");
                })->orderByDesc('_id')->paginate($this->response()->pagination($request));

            return $data;
        } else {
            return $this->response()->error('code room salah dan anda tidak bisa melihat percakapan room user lain');
        }
    }

    public function sendChatMentorRepositories($request)
    {
        DB::beginTransaction();
        try {
            // mentor tidak perlu repot bikin room karena room konsultasi 
            // akan dibuat otomatis by sistem ketika mentee nya menghubungi
            if (!$mentor = Mentor::where([
                ['role_id', '=', 7],
                ['id', $request->mentor_user_id],
            ])->first()) {
                return $this->response()->error('mentor tidak ditemukan');
            } else {
                //jika sudah punya profile maka name nya dari nama lengkap akan tetapi jika belum punya profile maka name nya dari username
                if (!$userProfile = Profile::whereusers_id(Auth::guard('user')->user()->id)->first()) {
                    $nameUserProfile = Auth::guard('user')->user()->username;
                } else {
                    $nameUserProfile = $userProfile->nama_lengkap;
                }
                // check if sudah hubungi mentor sebelumnya maka pake room sebelumnya
                // akan tetapi jika belum maka create room baru
                if ($mentee = Mentorship::where([
                    ['mentee.id', '=', Auth::guard('user')->user()->id],
                    ['mentor.id', '=', $mentor->id]
                ])->first()) {
                    $code = $mentee->code;
                } else {
                    $code = $this->codeRoom();
                }
                // kirim pesan ke mentor + create room
                $room = Mentorship::updateOrCreate(
                    ['code' => $code],
                    [
                        'title' => 'room konsultasi dengan mentor ' . $mentor->username,
                        'desc' => 'room konsultasi',
                        'code' => $code,
                        'status' => 'active',
                        'mentor' => array('id' => $mentor->id, 'name' => $mentor->username),
                        'mentee' => array('id' => Auth::guard('user')->user()->id, 'name' => $nameUserProfile),
                    ]
                );
                $room['message'] = MessageRoomMentee::create([
                    'message' => $request->message,
                    'code' => $room->code,
                    'mentee' => array('id' => Auth::guard('user')->user()->id, 'nama' => $nameUserProfile),
                ]);
                DB::commit();
                return $this->response()->ok($room, 'Successfully Data');
            }
        } catch (\Exception $error) {
            DB::rollBack();
            return $this->response()->error($error);
        }
    }
}
