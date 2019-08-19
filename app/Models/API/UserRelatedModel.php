<?php

namespace App\Models\API;

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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['user_id'];

    /**
     * Database: Get the user_id attr from the Tab related model
     *
     * @return mixed
     */
    public function getUserIdAttribute()
    {
        return UserModel::find($this->user_model_id)->user_id ?? null;
    }

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
