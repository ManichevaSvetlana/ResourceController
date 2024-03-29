<?php

namespace App\Models\HelpModels;

use App\Scopes\UserAccessScope;
use App\Scopes\UserRelatedAccessScope;
use Illuminate\Database\Eloquent\Model;

class UserRelatedModel extends PermissionModel
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserRelatedAccessScope); // get entities only for the current user || all entities if request is from Laravel Nova (admin panel)
    }
}
