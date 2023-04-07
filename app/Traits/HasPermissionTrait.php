<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermissionTrait
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'roles_users');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permissions_users');
    }

    public function hasRoles(...$roles): bool
    {
        foreach ($roles as $slug)
            if($this->roles->contains('slug', $slug))
                return true;

        return false;
    }

    protected function getPermissionsBySlugs(array $permissions): array{
        return Permission::whereIn('slug', $permissions)->get();
    }

    protected function hasPermission($permission): bool
    {
        return $this->permissions->contains('slug', $permission->slug);
    }

    protected function hasPermissionThroughRole(Permission $permission){
        foreach ($permission->roles as $role)
            if($this->roles->contains($role))
                return true;

        return false;
    }

    public function hasPermissionComplete(Permission $permission): bool{
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }
}
