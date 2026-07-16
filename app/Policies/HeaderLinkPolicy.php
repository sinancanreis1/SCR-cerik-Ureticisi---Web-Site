<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\HeaderLink;
use Illuminate\Auth\Access\HandlesAuthorization;

class HeaderLinkPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:HeaderLink');
    }

    public function view(AuthUser $authUser, HeaderLink $headerLink): bool
    {
        return $authUser->can('View:HeaderLink');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:HeaderLink');
    }

    public function update(AuthUser $authUser, HeaderLink $headerLink): bool
    {
        return $authUser->can('Update:HeaderLink');
    }

    public function delete(AuthUser $authUser, HeaderLink $headerLink): bool
    {
        return $authUser->can('Delete:HeaderLink');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:HeaderLink');
    }

    public function restore(AuthUser $authUser, HeaderLink $headerLink): bool
    {
        return $authUser->can('Restore:HeaderLink');
    }

    public function forceDelete(AuthUser $authUser, HeaderLink $headerLink): bool
    {
        return $authUser->can('ForceDelete:HeaderLink');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:HeaderLink');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:HeaderLink');
    }

    public function replicate(AuthUser $authUser, HeaderLink $headerLink): bool
    {
        return $authUser->can('Replicate:HeaderLink');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:HeaderLink');
    }

}