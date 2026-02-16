<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\JadwalHariIni;
use Illuminate\Auth\Access\HandlesAuthorization;

class JadwalHariIniPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:JadwalHariIni');
    }

    public function view(AuthUser $authUser, JadwalHariIni $jadwalHariIni): bool
    {
        return $authUser->can('View:JadwalHariIni');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:JadwalHariIni');
    }

    public function update(AuthUser $authUser, JadwalHariIni $jadwalHariIni): bool
    {
        return $authUser->can('Update:JadwalHariIni');
    }

    public function delete(AuthUser $authUser, JadwalHariIni $jadwalHariIni): bool
    {
        return $authUser->can('Delete:JadwalHariIni');
    }

    public function restore(AuthUser $authUser, JadwalHariIni $jadwalHariIni): bool
    {
        return $authUser->can('Restore:JadwalHariIni');
    }

    public function forceDelete(AuthUser $authUser, JadwalHariIni $jadwalHariIni): bool
    {
        return $authUser->can('ForceDelete:JadwalHariIni');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:JadwalHariIni');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:JadwalHariIni');
    }

    public function replicate(AuthUser $authUser, JadwalHariIni $jadwalHariIni): bool
    {
        return $authUser->can('Replicate:JadwalHariIni');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:JadwalHariIni');
    }

}