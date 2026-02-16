<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\DataLab;
use Illuminate\Auth\Access\HandlesAuthorization;

class DataLabPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:DataLab');
    }

    public function view(AuthUser $authUser, DataLab $dataLab): bool
    {
        return $authUser->can('View:DataLab');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:DataLab');
    }

    public function update(AuthUser $authUser, DataLab $dataLab): bool
    {
        return $authUser->can('Update:DataLab');
    }

    public function delete(AuthUser $authUser, DataLab $dataLab): bool
    {
        return $authUser->can('Delete:DataLab');
    }

    public function restore(AuthUser $authUser, DataLab $dataLab): bool
    {
        return $authUser->can('Restore:DataLab');
    }

    public function forceDelete(AuthUser $authUser, DataLab $dataLab): bool
    {
        return $authUser->can('ForceDelete:DataLab');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:DataLab');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:DataLab');
    }

    public function replicate(AuthUser $authUser, DataLab $dataLab): bool
    {
        return $authUser->can('Replicate:DataLab');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:DataLab');
    }

}