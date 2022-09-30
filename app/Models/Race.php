<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Race extends WarcraftGroup
{
    public static $routeNamePrefix = 'race';
  
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
