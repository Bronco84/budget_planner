<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Transaction extends Model
{

    use LogsActivity;

	public $dates = [
		'date'
	];

	public $include = [
		'formatted_amount'
	];

    protected static $logAttributes = ['*'];

    protected static $logOnlyDirty = true;

    protected static $logAttributesToIgnore = [ 'updated_at'];
    
    protected static $submitEmptyLogs = false;

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['budget'];

    public function budget(){
        return $this->belongsTo('App\Budget');
    }

    /**
     * Set the transaction's amount.
     *
     * @param  integer  $value
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
    	return '$' . number_format(($this->amount_in_cents/100), 2, '.', ',');
    }
}
