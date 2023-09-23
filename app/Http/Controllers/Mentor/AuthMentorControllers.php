<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Interface\MentorInterface;
use Illuminate\Http\Request;
use App\Repositories\v_1\AuthMentorRepositories;

class AuthMentorControllers extends Controller implements MentorInterface
{
    use AuthMentorRepositories;
}
