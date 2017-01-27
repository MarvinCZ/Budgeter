<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Transaction;
use App\Models\MemberTransaction;

class TransactionController extends Controller
{
    public function create($group_id)
    {
        $group = Group::findOrFail($group_id);
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
}
