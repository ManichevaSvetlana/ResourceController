<?php

namespace App\Http\API\Controllers;

use App\Http\Controllers\HelpControllers\AdminResourceController;
use Illuminate\Http\Request;

class AdminModelController extends AdminResourceController
{
    /*
     * Var: the classname of the resource.
     *
     * @string
     */
    protected $class = 'App\Models\API\AdminModel';

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
    protected $storable = ['name'];
}
