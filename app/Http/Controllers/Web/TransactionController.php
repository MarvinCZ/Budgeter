<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransaction;
use App\Models\Group;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\MemberTransaction;
use \Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(\App\Models\Group $group)
    {
        return redirect()->route('group.show', $group);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Models\Group $group, StoreTransaction $request)
    {
        $data = $request->all();

        $transaction = new Transaction($data);
        $transaction->group()->associate($group);

        //should not happen request is validated already
        $transaction->saveOrFail();

        //TODO create revers transaction

        $price = (int)($data['value'] / count($data['member_ids']));
        $data = [];
        foreach ($request->all()['member_ids'] as $id) {
            $data []= [
                'description' => $transaction->description,
                'value' => $price,
                'member_id' => $id,
                'transaction_id' => $transaction->id
            ];
        }
        MemberTransaction::insert($data);

        return redirect()->route('group.show', $group);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Group $group)
    {
        return view('group.show', [
            'user' => User::first(),
            'group' => $group
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
