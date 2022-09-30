<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\WarcraftGroup;

class Ability extends Model
{
    use HasFactory;
    
    public $table = 'abilities_warcraft';
    
    public $fillable = [
        'title','description','color','feature_type'
    ];
    
    public function feature()
    {
        return $this->belongsTo(WarcraftGroup::class,'feature_id');
    }
	
    /**
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
	 *
     * @return void
     */
	protected function scopeHasNotForAdmin($query,$relation)
	{
		if(auth()->user()->cant('admin')){
			$query->has($relation);
		}
	}
}
