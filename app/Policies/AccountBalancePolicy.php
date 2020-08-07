<?php

namespace App\Policies;

use App\AccountBalance;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountBalancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\AccountBalance  $accountBalance
     * @return mixed
     */
    public function view(User $user, AccountBalance $accountBalance)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\AccountBalance  $accountBalance
     * @return mixed
     */
    public function update(User $user, AccountBalance $accountBalance)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\AccountBalance  $accountBalance
     * @return mixed
     */
    public function delete(User $user, AccountBalance $accountBalance)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\AccountBalance  $accountBalance
     * @return mixed
     */
    public function restore(User $user, AccountBalance $accountBalance)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\AccountBalance  $accountBalance
     * @return mixed
     */
    public function forceDelete(User $user, AccountBalance $accountBalance)
    {
        //
    }
}
