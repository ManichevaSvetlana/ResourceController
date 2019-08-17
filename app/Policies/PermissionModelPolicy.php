<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class PermissionModelPolicy
{
    use HandlesAuthorization;

    /**
     * Can view list of models: Nova permission.
     *
     * @return boolean
     */
    public function viewAny()
    {
        return true;
    }

    /**
     * Can update the model's entity: Nova permission.
     *
     * @return boolean
     */
    public function update()
    {
        return true;
    }

    /**
     * Can delete the model's entity: Nova permission.
     *
     * @return boolean
     */
    public function delete()
    {
        return true;
    }

    /**
     * Can create the model's entity: Nova permission.
     *
     * @return boolean
     */
    public function create()
    {
        return true;
    }

    /**
     * Can view the model's entity: Nova permission.
     *
     * @return boolean
     */
    public function view()
    {
        return true;
    }

    /**
     * User access to the entity.
     * @param User $user
     * @param Model $resource
     * @return boolean
     */
    public function userAccess(User $user, Model $resource)
    {
        return $resource->user_id == $user->id;
    }

    /**
     * Admin access to the entity.
     * @param User $user
     * @param Model $resource
     * @return boolean
     */
    public function adminAccess(User $user)
    {
        return $user->admin();
    }
}
