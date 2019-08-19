<?php

namespace App\Http\Controllers\HelpControllers;

class AdminResourceController extends ResourceController
{
    /*
    * Var: the name of the policies for admin methods: update, store, delete.
    *
    * @array
    */
    protected $policies = ['update' => 'adminAccess', 'store' => 'adminAccess', 'delete' => 'adminAccess'];
}
