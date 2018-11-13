<?php

namespace App\Policies;

use App\User;
use App\Personnel\Info\EmpBasic;
use Illuminate\Auth\Access\HandlesAuthorization;

class BasicPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the emp basic.
     *
     * @param  \App\User  $user
     * @param  \App\Personnel\Info\EmpBasic  $empBasic
     * @return mixed
     */
    public function view(User $user, EmpBasic $empBasic)
    {
        return $user->id === $empBasic->user_id;
    }

    /**
     * Determine whether the user can create emp basics.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the emp basic.
     *
     * @param  \App\User  $user
     * @param  \App\Personnel\Info\EmpBasic  $empBasic
     * @return mixed
     */
    public function update(User $user, EmpBasic $empBasic)
    {
        //
    }

    /**
     * Determine whether the user can delete the emp basic.
     *
     * @param  \App\User  $user
     * @param  \App\Personnel\Info\EmpBasic  $empBasic
     * @return mixed
     */
    public function delete(User $user, EmpBasic $empBasic)
    {
        //
    }

    /**
     * Determine whether the user can restore the emp basic.
     *
     * @param  \App\User  $user
     * @param  \App\Personnel\Info\EmpBasic  $empBasic
     * @return mixed
     */
    public function restore(User $user, EmpBasic $empBasic)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the emp basic.
     *
     * @param  \App\User  $user
     * @param  \App\Personnel\Info\EmpBasic  $empBasic
     * @return mixed
     */
    public function forceDelete(User $user, EmpBasic $empBasic)
    {
        //
    }
}
