<?php

namespace App\Http\Controllers\API\Resources;

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

    /*
     * Var: the array of the model's fields that will be returned after search request
     *
     * @array
     */
    protected $searchFields = ['id', 'name'];

    /*
     * Var: if the resource should paginate (0 if pagination not needed).
     *
     * @integer
     */
    protected $pagination = 10;
}
