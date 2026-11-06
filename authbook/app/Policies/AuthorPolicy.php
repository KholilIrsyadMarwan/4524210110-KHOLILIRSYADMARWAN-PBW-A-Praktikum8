<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;

class AuthorPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Author $author): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    public function update(User $user, Author $author): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }

    public function delete(User $user, Author $author): bool
    {
        return $user->isAdmin();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Author $author): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Author $author): bool
    {
        return $user->isAdmin();
    }
}