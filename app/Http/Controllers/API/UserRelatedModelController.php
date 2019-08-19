<?php

namespace App\Http\API\Controllers;

use App\Http\Controllers\HelpControllers\UserResourceController;
use Illuminate\Http\Request;

class UserRelatedModelController extends UserResourceController
{
    /*
     * Var: the classname of the resource.
     *
     * @string
     */
    protected $class = 'App\Models\API\UserRelatedModel';

    /*
     * Var: the attributes that can be updated.
     *
     * @array
     */
    protected $updatable = ['name', 'user_model_id'];

    /*
     * Var: the attributes that can be stored.
     *
     * @array
     */
    protected $storable = ['name', 'user_model_id'];

    /*
     * Var: the fields for update or create method.
     *
     * @array
     */
    protected $updateOrCreateFields = ['user_model_id'];

    /*
     * Var: if the resource can be created if doesnt exist for update.
     *
     * @bool
     */
    protected $updateOrCreate = true;
}
