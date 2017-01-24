<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Member;
use App\Models\Group;

class GroupController extends Controller
{
    public function dashboard()
    {
        return view('dashboard', ['user' => User::first(), 'members' => Member::paginate(3)]);
    }

    public function administrateMembers($group_id)
    {
        return view('administrateMembers', ['user' => User::first(), 'members' => Member::paginate(3), 'group' => Group::first()]);
    }

    public function addMember($group_id)
    {
        return redirect("/group/#{$group_id}/members");
    }

    public function removeMember($group_id)
    {
        return redirect("/group/#{$group_id}/members");
    }
}
