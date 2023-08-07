<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Transaction extends Model
{

    use LogsActivity;

    public $guarded = ['created_at', 'updated_at', 'id'];

    protected static $recordEvents = ['updated'];

	public $casts = [
		'date' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
	];

	public $include = [
		'formatted_amount'
	];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['budget'];

    public function getActivitylogOptions(): LogOptions
    {

        return LogOptions::defaults()
        ->logUnguarded()
        ->logOnlyDirty();
    }

    public function budget(){
        return $this->belongsTo(Budget::class);
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
