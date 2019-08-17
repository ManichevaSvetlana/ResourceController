<?php

namespace App\API;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRelatedModel extends \App\Models\HelpModels\UserRelatedModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_model_id',
    ];

    /**
     * Relationship: Get the user models by user_model_id attr
     *
     * @return BelongsTo
     */
    public function userModels()
    {
        return $this->belongsTo(UserModel::class);
    }
}
