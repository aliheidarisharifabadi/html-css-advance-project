<?php

namespace App\Policies;

use App\Models\Common\Option;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can index the options
     *
     * @param  \App\Models\User\User $user
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->can('option.index');
    }

    /**
     * Determine whether the user can show the option.
     *
     * @param  \App\Models\User\User $user
     * @param option                 $option
     * @return mixed
     */
    public function show(User $user, option $option)
    {
        return $user->can('option.show');
    }

    /**
     * Determine whether the user can store options.
     *
     * @param  \App\Models\User\User $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->can('option.store');
    }

    /**
     * Determine whether the user can edit the option.
     *
     * @param  \App\Models\User\User $user
     * @param option                 $option
     * @return mixed
     */
    public function edit(User $user, option $option)
    {
        return $user->can('option.edit');
    }

    /**
     * Determine whether the user can update the option.
     *
     * @param  \App\Models\User\User $user
     * @param option                 $option
     * @return mixed
     */
    public function update(User $user, option $option)
    {
        return $user->can('option.update');
    }

}
