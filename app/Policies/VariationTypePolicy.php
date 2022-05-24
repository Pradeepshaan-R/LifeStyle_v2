<?php

namespace App\Policies;

use App\Domains\Auth\Models\User;
use App\Models\VariationType;
use Illuminate\Auth\Access\HandlesAuthorization;

class VariationTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('VARIATIONTYPE_LIST');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\VariationType  $variationType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, VariationType $variationType)
    {
        return $user->can('VARIATIONTYPE_VIEW');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('VARIATIONTYPE_CREATE');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\VariationType  $variationType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, VariationType $variationType)
    {
        return $user->can('VARIATIONTYPE_EDIT');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\VariationType  $variationType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, VariationType $variationType)
    {
        return $user->can('VARIATIONTYPE_DELETE');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\VariationType  $variationType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, VariationType $variationType)
    {
        return $user->can('VARIATIONTYPE_EDIT');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\VariationType  $variationType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, VariationType $variationType)
    {
        return $user->can('VARIATIONTYPE_DELETE');
    }
}
