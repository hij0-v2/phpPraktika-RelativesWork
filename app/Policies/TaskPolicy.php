<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->is_admin;
    }

    public function update(User $user, Task $task)
    {
        return $user->is_admin;
    }

    public function delete(User $user, Task $task)
    {
        return $user->is_admin;
    }

}
