<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Cek apakah user dapat mengelola pengguna lain
     */
    public function manageUsers(User $user): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Cek apakah user dapat melihat pengguna lain
     */
    public function view(User $user, User $model): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Cek apakah user dapat memperbarui pengguna lain
     */
    public function update(User $user, User $model): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Cek apakah user dapat menghapus pengguna lain
     */
    public function delete(User $user, User $model): bool
    {
        return $user->isSuperAdmin() && $user->id !== $model->id;
    }
}