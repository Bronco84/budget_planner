<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{


	public $dates = [
		'date'
	];

	public $include = [
		'formatted_amount'
	];

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setAmountInCentsAttribute($value)
    {
        $this->attributes['amount_in_cents'] = bcmul($value, 100);
    }

    public function getFormattedDateAttribute()
    {
    	return $this->date ? $this->date->format('F d, Y') : $this->date;
    }

    public function getFormattedAmountAttribute()
    {
    	return '$' . $this->amount_in_cents/100;
    }
}