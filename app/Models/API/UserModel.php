<?php

namespace App\Models\API;

use App\Models\HelpModels\UserRelatedModel;
use App\User;
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'user_name',
    ];

    /**
     * Database: Get the user name attr
     *
     * @return string
     */
    public function getUserNameAttribute()
    {
        return $this->user ? $this->user->name.' - '.$this->user->email : null;
    }

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
