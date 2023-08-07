<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountBalance extends Model
{



	public $casts = [
		'as_of_date' => 'datetime',
	];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['budget'];

    public function budget(){
        return $this->belongsTo(Budget::class);
    }

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
