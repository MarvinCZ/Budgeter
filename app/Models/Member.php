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
        return $this->belongsTo('App\Models\Group');
    }

    public function memberTransaction()
    {
        return $this->hasMany('App\Models\MemberTransaction');
    }

    public function setCachedBudgetAttribute()
    {
        throw new \App\Exceptions\ReadOnlyAttributeException("Can not set cachedBudget directly.");
    }
}
