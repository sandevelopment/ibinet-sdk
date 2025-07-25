<?php

namespace Ibinet\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $table = 'role_permissions';

    public function permission() 
    {
        return $this->hasOne(Permission::class, 'id', 'permission_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [
        'created_at',
        'updated_at'
    ];
}
