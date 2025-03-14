<?php

namespace Ibinet\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Contracts\Activity;
use Ramsey\Uuid\Uuid;

class Ticket extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    protected static $logName = 'Ticket';
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    public $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function remote()
    {
        return $this->belongsTo('Ibinet\Models\Remote', 'remote_id');
    }

    public function user()
    {
        return $this->belongsTo('Ibinet\Models\User');
    }

    public function project()
    {
        return $this->belongsTo('Ibinet\Models\Project');
    }

    public function created_by()
    {
        return $this->belongsTo('Ibinet\Models\User', 'created_by');
    }
    
    public function createdBy()
    {
        return $this->belongsTo('Ibinet\Models\User', 'created_by');
    }

    public function expenseReportRemote()
    {
        return $this->hasOne('Ibinet\Models\ExpenseReportRemote', 'ticket_id');
    }

    public function timers()
    {
        return $this->hasMany('Ibinet\Models\TicketTimer', 'ticket_id');
    }

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string) Uuid::uuid4();
        });
    }
}
