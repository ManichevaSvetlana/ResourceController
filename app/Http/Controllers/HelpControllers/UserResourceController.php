<?php

namespace App\Http\Controllers\HelpControllers;


class UserResourceController extends ResourceController
{
    /*
     * Var: the name of the policies for methods (empty if no policies needed).
     *
     * @array
     */
    protected $policies = ['delete' => 'userAccess', 'update' => 'userAccess'];
}
