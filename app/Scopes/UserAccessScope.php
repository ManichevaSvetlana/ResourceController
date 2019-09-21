<?php


namespace App\Scopes;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Route;


class UserAccessScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return mixed
     *
     * @throws \Exception
     */
    public function apply(Builder $builder, Model $model)
    {
        if(auth()->check()){
            $user = auth()->user();
            if($user->admin()) return $builder; // if the user is admin (could be changed to nova rout checkout: strrpos(Route::currentRouteName(), 'nova') !== false)
            return $builder->where('user_id', $user->id);
        }
        return $builder;
    }
}
