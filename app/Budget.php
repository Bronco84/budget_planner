<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }    

    public function account_balances()
    {
        return $this->hasMany('App\AccountBalance');
    }

    /**
    * The products that belong to the shop.
    */
    public function connected_budgets()
    {
        return $this->belongsToMany('App\User');
    }
}
