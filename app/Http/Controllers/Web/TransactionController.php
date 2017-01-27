<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Transaction;
use App\Models\MemberTransaction;

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
        $transaction = new Transaction();
        $transaction->description = $_POST['t_description'];
        $transaction->group()->associate($group);
        $transaction->save();

        $payer = $_POST['t_payer'];
        $this->createMemberTransaction($transaction, $payer, $_POST['t_value']);
        $count = count($_POST['t_member_ids']);
        if($count == 0)
            //TODO: Vyfuckovat
        $amount = $_POST['t_value'] / $count;

        foreach($_POST['t_member_ids'] as $member_id) {
            $this->createMemberTransaction($transaction, $member_id, -$amount);
        }

        return redirect()->route('dashboard', $group_id);
    }

    //TODO: Remake function to just make the model, not create and use 1 query to insert all of them
    private function createMemberTransaction($transaction, $member_id, $value)
    {
        $mTransaction = new MemberTransaction();
        $mTransaction->description = $transaction->description;
        $mTransaction->value = $value;
        //TODO: Use relationships
        $mTransaction->member_id = $member_id;
        $mTransaction->transaction_id = $transaction->id;
        $mTransaction->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
