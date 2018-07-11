<?php

namespace QuadStudio\Rbac\Models;

use Illuminate\Database\Eloquent\Model;
use QuadStudio\Rbac\Contracts\PermissionInterface;
use QuadStudio\Service\Site\Models\User;

class Permission extends Model implements PermissionInterface
{

    protected $fillable = [
        'name', 'title', 'parent_id', 'description'
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
        $this->table = env('DB_PREFIX', '') . 'permissions';
    }

    public function syncRoles($roles)
    {
        if (!is_array($roles)) {
            $roles = [$roles];
        }
        $this->roles()->sync($roles);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        if (config('site::cache.use', true) === true) {
            $key = $this->primaryKey;
            $cacheKey = 'rbac_permission_roles_' . $this->{$key};

            return cache()->remember($cacheKey, config('site::cache.ttl'), function () {
                return $this->_roles();
            });
        }

        return $this->_roles();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function _roles()
    {
        return $this->belongsToMany(
            Role::class,
            env('DB_PREFIX', '') . 'permission_role',
            'permission_id',
            'role_id'
        );
    }


    public function users()
    {
        return User::whereHas('roles.permissions', function ($query) {
            $query->where('permissions.id', $this->id);
        });
    }

    /**
     * @param $role
     * @return $this
     */
    public function attachRole($role)
    {
        if ($role instanceof Role) {
            $role = $role->getKey();
        }
        if (is_array($role)) {
            return $this->attachRoles($role);
        }
        $this->roles()->attach($role);

        return $this;
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function attachRoles(array $roles)
    {
        foreach ($roles as $role) {
            $this->attachRole($role);
        }

        return $this;
    }

    /**
     * @param $role
     * @return $this
     */
    public function detachRole($role)
    {

        if ($role instanceof Role) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            return $this->detachRoles($role);
        }

        $this->roles()->detach($role);

        return $this;
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function detachRoles(array $roles)
    {

        if (empty($roles)) {
            $roles = $this->roles();
        }

        foreach ($roles as $role) {
            $this->detachRole($role);
        }

        return $this;
    }

}
