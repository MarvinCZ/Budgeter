<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class Group extends BaseModel
{
    use ValidatingTrait;

    protected $rules = [
        'name' => 'required|max:50',
        'cached_budget' => 'required|numeric',
        'user_id' => 'exists:users,id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
