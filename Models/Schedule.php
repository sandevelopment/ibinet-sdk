<?php

namespace Ibinet\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;

class Schedule extends Model
{
    public $incrementing = false;

    public $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'created_at', 'updated_at'
    ];

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

    /**
     * Get the remote that owns the Schedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function remote(): BelongsTo
    {
        return $this->belongsTo(Remote::class, 'remote_id');
    }

    /**
     * Get the project that owns the Schedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * Get the user that owns the Schedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all of the expenseReportRemotes for the Schedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenseReportRemotes(): HasMany
    {
        return $this->hasMany(ExpenseReportRemote::class, 'schedule_id', 'id');
    }
}
