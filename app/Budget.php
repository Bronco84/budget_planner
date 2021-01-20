<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Budget extends Model
{
    use LogsActivity;

    public $fillable = ['description', 'months_for_projection', 'notes'];

    protected static $logAttributes = ['transactions.description'];

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }       

    public function created_by_user()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }    

    public function account_balances()
    {
        return $this->hasMany('App\AccountBalance');
    }

    public function connected_budgets()
    {
        return $this->belongsToMany('App\User');
    }
}
