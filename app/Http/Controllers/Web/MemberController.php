<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Models\Group $group)
    {
        return view('members.form', [
            'member' => new Member(),
            'route' => ['members.store', $group],
            'method' => 'POST'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Group $group, \App\Models\Member $member)
    {
        $sum = $member->memberTransactions->sum('value');
        return view('members.show', [
            'member' => $member,
            'sum' => $sum,
            'group' => $group
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Models\Group $group, \App\Models\Member $member)
    {
        return view('members.form', [
            'member' => $member,
            'route' => ['members.update', $group, $member],
            'method' => 'PUT'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Models\Group $group, Request $request)
    {
        $member = new Member($request->all());
        $member->group()->associate($group);
        if (!$member->save()) {
            return redirect()
                ->back()
                ->withErrors($member->getErrors())
                ->withInput();
        }

        return redirect()
            ->route('members.show', [$group, $member]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Models\Group $group, \App\Models\Member $member)
    {
        $member->fill($request->all());
        if (!$member->save()) {
            return redirect()
                ->back()
                ->withErrors($member->getErrors())
                ->withInput();
        }

        return redirect()
            ->route('members.show', [$group, $member]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Models\Group $group, \App\Models\Member $member)
    {
        $member->delete();

        return redirect()->route('group.show', $group);
    }
}
