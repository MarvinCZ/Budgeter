<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberTransaction extends BaseModel
{
    protected $table = 'member_transactions';

    protected $rules = [
        'transaction_id' => 'nullable|exists:transactions:id',
        'member_id' => 'required|exists:members,id',
        'value' => 'required|numeric',
        'description' => 'required|max:150'
    ];

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }
}
