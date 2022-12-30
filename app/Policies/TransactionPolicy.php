<?php

namespace App\Policies;

use App\Models\Budget;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Transaction $transaction)
    {
        return $user->hasBudget($transaction->budget);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Budget  $budget
     * @return mixed
     */
    public function view(User $user, Transaction $transaction)
    {
        return $user->hasBudget($transaction->budget);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Budget $budget)
    {
        return $user->hasBudget($budget);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Budget  $budget
     * @return mixed
     */
    public function update(User $user, Budget $budget)
    {
        return $user->hasBudget($budget);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Budget  $budget
     * @return mixed
     */
    public function delete(User $user, Budget $budget)
    {
        return $user->hasBudget($budget);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Budget  $budget
     * @return mixed
     */
    public function restore(User $user, Budget $budget)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Budget  $budget
     * @return mixed
     */
    public function forceDelete(User $user, Budget $budget)
    {
        //
    }
}
