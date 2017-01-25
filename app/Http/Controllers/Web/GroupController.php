<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Member;
use App\Models\Group;

class GroupController extends Controller
{
    public function dashboard($group_id)
    {
        $group_id = 1;
        //TODO: Do not send the current user's member account with the other members because no one can owe themselves
        return view('dashboard', ['user' => User::first(), 'group' => Group::where('id', $group_id)->first()]);
    }

    public function administrateMembers($group_id)
    {
        $group = Group::first();
        $members = $group->members()->get();
        return view('administrateMembers', ['user' => User::first(), 'members' => $members, 'group' => $group]);
    }

    public function addMembers($group_id)
    {
        return redirect()->route('members', $group_id);
    }

    public function removeMembers($group_id)
    {
        $members = Member::find($_POST['member_ids']);

        foreach($members as $member) {
            $member->delete();
        }

        return redirect()->route('members', $group_id);
    }
}
