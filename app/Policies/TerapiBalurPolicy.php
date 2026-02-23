<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TerapiBalur;
use Illuminate\Auth\Access\HandlesAuthorization;

class TerapiBalurPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TerapiBalur');
    }

    public function view(AuthUser $authUser, TerapiBalur $terapiBalur): bool
    {
        return $authUser->can('View:TerapiBalur');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TerapiBalur');
    }

    public function update(AuthUser $authUser, TerapiBalur $terapiBalur): bool
    {
        return $authUser->can('Update:TerapiBalur');
    }

    public function delete(AuthUser $authUser, TerapiBalur $terapiBalur): bool
    {
        return $authUser->can('Delete:TerapiBalur');
    }

    public function restore(AuthUser $authUser, TerapiBalur $terapiBalur): bool
    {
        return $authUser->can('Restore:TerapiBalur');
    }

    public function forceDelete(AuthUser $authUser, TerapiBalur $terapiBalur): bool
    {
        return $authUser->can('ForceDelete:TerapiBalur');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TerapiBalur');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TerapiBalur');
    }

    public function replicate(AuthUser $authUser, TerapiBalur $terapiBalur): bool
    {
        return $authUser->can('Replicate:TerapiBalur');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TerapiBalur');
    }

}