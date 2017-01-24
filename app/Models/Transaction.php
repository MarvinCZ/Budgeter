<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends BaseModel
{
    protected $table = 'transactions';

    protected $rules = [
        'group_id' => 'required|exists:groups,id',
        'value' => 'required|numeric',
        'description' => 'required|max:150'
    ];

    protected $attributes = [
        'value' => 0
    ];

    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    public function updateValue()
    {
        $sum = (int)$this->memberTransactions()->sum('value');
        $this->attributes['value'] = $sum;
        $this->save();
    }

    public function memberTransactions()
    {
        return $this->hasMany('App\Models\MemberTransaction');
    }

    public function setValueAttribute()
    {
        throw new \App\Exceptions\ReadOnlyAttributeException("Can not set value directly.");
    }

    public function isCompeted()
    {
        return $this->value == 0;
    }
}
