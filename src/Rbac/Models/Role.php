<?php

namespace QuadStudio\Rbac\Models;

use Illuminate\Database\Eloquent\Model;
use QuadStudio\Rbac\Contracts\RoleInterface;
use QuadStudio\Service\Site\Models\User;

class Role extends Model implements RoleInterface
{

    protected $fillable = [
        'name', 'title', 'description'
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
        $this->table = env('DB_PREFIX', '') . 'roles';
    }

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {

        return $this->belongsToMany(
            User::class,
            env('DB_PREFIX', '') . 'role_user',
            'role_id',
            'user_id'
        );
    }

    /**
     * @param $permission
     * @return $this
     */
    public function attachPermission($permission)
    {
        if ($permission instanceof Permission) {
            $permission = $permission->getKey();
        }
        if (is_array($permission)) {
            return $this->attachPermissions($permission);
        }
        $this->permissions()->attach($permission);

        return $this;
    }

    /**
     * @param array $permissions
     * @return $this
     */
    public function attachPermissions(array $permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }

        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        if (config('site::cache.use', true) === true) {
            $key = $this->primaryKey;
            $cacheKey = 'rbac_role_permissions_' . $this->{$key};

            return cache()->remember($cacheKey, config('site::cache.ttl'), function () {
                return $this->_permissions();
            });
        }

        return $this->_permissions();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function _permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            env('DB_PREFIX', '') . 'permission_role',
            'role_id',
            'permission_id'
        );
    }

    /**
     * @param $permission
     * @return $this
     */
    public function detachPermission($permission)
    {

        if ($permission instanceof Permission) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            return $this->detachPermissions($permission);
        }

        $this->permissions()->detach($permission);

        return $this;
    }

    /**
     * @param array $permissions
     * @return $this
     */
    public function detachPermissions(array $permissions)
    {

        if (empty($permissions)) {
            $permissions = $this->permissions();
        }

        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }

        return $this;
    }


    public function syncPermissions($permissions)
    {
        if (!is_array($permissions)) {
            $permissions = [$permissions];
        }
        $this->permissions()->sync($permissions);
    }

}
