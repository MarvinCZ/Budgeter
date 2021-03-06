<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberTransaction extends BaseModel
{
    protected $table = 'member_transactions';

    protected $rules = [
        'transaction_id' => 'required|exists:transactions,id',
        'member_id' => 'required|exists:members,id',
        'value' => 'required|numeric',
        'description' => 'required|max:150'
    ];

    public static function boot()
    {
        parent::boot();

        static::saved(function (self $transaction) {
            $transaction->member->updateCachedBudget();
        });
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction', 'transaction_id');
    }
}
