<?php

namespace QuadStudio\Rbac\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{

    protected $fillable = [
        'permission_id', 'role_id'
    ];

    /**
     * @var string
     */
    protected $table;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'permission_role';
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
