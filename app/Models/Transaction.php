<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends BaseModel
{
    protected $table = 'transactions';

    protected $fillable = ['value', 'description'];

    protected $rules = [
        'group_id' => 'required|exists:groups,id',
        'value' => 'required|numeric',
        'description' => 'required|max:150'
    ];

    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    public function memberTransactions()
    {
        return $this->hasMany('App\Models\MemberTransaction');
    }
}
