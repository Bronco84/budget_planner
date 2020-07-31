<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountBalance extends Model
{



	public $dates = [
		'as_of_date'
	];

     /**
     * Set the account's balance.
     *
     * @param  string  $value
     * @return void
     */
    public function setBalanceInCentsAttribute($value)
    {
        $this->attributes['balance_in_cents'] = bcmul($value, 100);
    }
}
