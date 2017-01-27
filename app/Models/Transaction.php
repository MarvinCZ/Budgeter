<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends BaseModel
{
    protected $table = 'transactions';

    protected $fillable = ['value', 'description', 'member_ids'];

    protected $rules = [
        'group_id' => 'required|exists:groups,id',
        'value' => 'required|numeric',
        'description' => 'required|max:150',
        'member_ids' => 'has_members|valid_members'
    ];

    public static function boot()
    {
        parent::boot();

        \Validator::extend('valid_members', function($attributes, $value, $parameters, \Illuminate\Validation\Validator $validator) {
            $count = Member::whereIn('id', $value)->count();
            return $count == count($value);
        });

        \Validator::extend('has_members', function($attributes, $value, $parameters, \Illuminate\Validation\Validator $validator) {
            return count($value) > 0;
        });

        static::saved(function (self $transaction) {
            //$transaction->member->updateCachedBudget();
        });
    }


    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    public function memberTransactions()
    {
        return $this->hasMany('App\Models\MemberTransaction');
    }
}
