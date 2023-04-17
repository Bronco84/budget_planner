<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Budget extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {

        return LogOptions::defaults()
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs()
        ->logExcept(['updated_at']);
    }


    public $fillable = ['description', 'months_for_projection', 'notes'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function account_balances()
    {
        return $this->hasMany(AccountBalance::class);
    }

    public function connected_users()
    {
        return $this->belongsToMany(User::class);
    }
}
