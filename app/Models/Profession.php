<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Profession extends WarcraftGroup
{
    public static $routeNamePrefix = 'profession';
  
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('class', function (Builder $builder) {
            $builder->where('group_type', static::class);
        });
        
        static::creating(function ($class) {
            $class->group_type = static::class;
        });
    }
}

