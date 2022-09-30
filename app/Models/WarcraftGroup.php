<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarcraftGroup extends Model
{
    use HasFactory, SoftDeletes;
    
    public $table = 'warcraft_group';
    
    public $fillable = [
        'title',
        'description',
        'color',
    ];
    
    public function abilities()
    {
        return $this->hasMany(\App\Models\Ability::class,'feature_id');
    }
	
    /**
     * Берем удаленные для админа.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
	protected function scopeWithTrashedIfAdmin($query)
	{
		if(auth()->user()->can('admin')){
			$query->withTrashed();
		}
	}
}
