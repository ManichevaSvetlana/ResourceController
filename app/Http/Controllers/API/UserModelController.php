<?php

namespace App\Http\API\Controllers;

use App\Http\Controllers\HelpControllers\UserResourceController;
use Illuminate\Http\Request;

class UserModelController extends UserResourceController
{
    /*
     * Var: the classname of the resource.
     *
     * @string
     */
    protected $class = 'App\Models\API\UserModel';

    /*
     * Var: the attributes that can be updated.
     *
     * @array
     */
    protected $updatable = ['name'];

    /*
     * Var: the attributes that can be stored.
     *
     * @array
     */
    protected $storable = ['name', 'user_id'];

    /*
     * Var: the name of the field that will be ordered.
     *
     * @string
     */
    protected $orderBy = 'updated_at';
}
