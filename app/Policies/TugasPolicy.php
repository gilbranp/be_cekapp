<?php

namespace App\Policies;

use App\Models\Tugas;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TugasPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Tugas $tugas)
    {
        return $user->id === $tugas->dibuat_oleh; // Hanya pemilik tugas yang bisa mengupdate
    }

    public function delete(User $user, Tugas $tugas)
    {
        return $user->id === $tugas->dibuat_oleh; // Hanya pemilik tugas yang bisa menghapus
    }
}

