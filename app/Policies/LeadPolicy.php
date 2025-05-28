<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lead;
class LeadPolicy
{

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user): bool
    {
        return $user->isAdmin();
    }

    public function edit(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Lead $lead): bool
    {
        return $user->isAdmin() || $user->id === $lead->assigned_to;
    }
}
