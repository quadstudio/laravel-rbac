<?php

namespace QuadStudio\Rbac\Models;

use Illuminate\Database\Eloquent\Model;
use QuadStudio\Rbac\Traits\Models\RbacUsers;

class RoleUser extends Model
{
    use RbacUsers;
    protected $fillable = [
        'role_id', 'user_id'
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
        $this->table = config('rbac.prefix', '') . 'role_user';
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(config("auth.providers.users.model"));
    }

}
