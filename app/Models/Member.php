<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends BaseModel
{
    protected $table = 'members';

    protected $rules = [
        'group_id' => 'exists:groups,id',
        'name' => 'required|max:50',
        'cached_budget' => 'required|numeric'
    ];

    protected $attributes = [
        'cached_budget' => 0
    ];

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function memberTransactions()
    {
        return $this->hasMany('App\Models\MemberTransaction');
    }

    public function updateCachedBudget()
    {
        $sum = (int)$this->memberTransactions()->sum('value');
        $this->attributes['cached_budget'] = $sum;
        $this->save();
    }

    public function setCachedBudgetAttribute()
    {
        throw new \App\Exceptions\ReadOnlyAttributeException("Can not set cachedBudget directly.");
    }
}
