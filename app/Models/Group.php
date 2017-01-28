<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class Group extends BaseModel
{
    use ValidatingTrait;

    protected $rules = [
        'name' => 'required|max:50',
        'user_id' => 'nullable|exists:users,id'
    ];

    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function members()
    {
        return $this->hasMany('App\Models\Member');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
