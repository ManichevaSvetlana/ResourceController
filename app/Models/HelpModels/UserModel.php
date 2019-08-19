<?php

namespace App\Models\HelpModels;

use App\Scopes\UserAccessScope;
use Illuminate\Database\Eloquent\Model;

class UserModel extends PermissionModel
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserAccessScope); // get entities only for the current user || all entities if request is from Laravel Nova (admin panel)
    }
}
