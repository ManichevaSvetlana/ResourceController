<?php

namespace App\API;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserModel extends \App\Models\HelpModels\UserModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id',
    ];

    /**
     * Relationship: Get the user by user_id attr
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Get the user related models
     *
     * @return HasMany
     */
    public function userRelatedModels()
    {
        return $this->hasMany(UserRelatedModel::class);
    }

}
