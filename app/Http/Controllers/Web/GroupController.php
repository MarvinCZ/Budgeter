<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Member;

class GroupController extends Controller
{
    public function dashboard()
    {
        return view('dashboard', ['user' => User::first(), 'members' => Member::paginate(3)]);
    }
}
