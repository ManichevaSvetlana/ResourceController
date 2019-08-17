<?php

namespace App\API;

use App\Models\HelpModels\PermissionModel;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends PermissionModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id',
    ];
}
