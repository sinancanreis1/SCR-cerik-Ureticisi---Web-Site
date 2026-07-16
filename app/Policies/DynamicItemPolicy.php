<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\DynamicItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class DynamicItemPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:DynamicItem');
    }

    public function view(AuthUser $authUser, DynamicItem $dynamicItem): bool
    {
        return $authUser->can('View:DynamicItem');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:DynamicItem');
    }

    public function update(AuthUser $authUser, DynamicItem $dynamicItem): bool
    {
        return $authUser->can('Update:DynamicItem');
    }

    public function delete(AuthUser $authUser, DynamicItem $dynamicItem): bool
    {
        return $authUser->can('Delete:DynamicItem');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:DynamicItem');
    }

    public function restore(AuthUser $authUser, DynamicItem $dynamicItem): bool
    {
        return $authUser->can('Restore:DynamicItem');
    }

    public function forceDelete(AuthUser $authUser, DynamicItem $dynamicItem): bool
    {
        return $authUser->can('ForceDelete:DynamicItem');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:DynamicItem');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:DynamicItem');
    }

    public function replicate(AuthUser $authUser, DynamicItem $dynamicItem): bool
    {
        return $authUser->can('Replicate:DynamicItem');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:DynamicItem');
    }

}