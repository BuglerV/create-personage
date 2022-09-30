<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    
    public $fillable = [
        'name',
        'user_id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function race()
    {
        return $this->belongsTo(Race::class);
    }
    
    public function warclass()
    {
        return $this->belongsTo(WarClass::class);
    }
    
    public function profession1()
    {
        return $this->belongsTo(Profession::class,'profession1_id');
    }
    
    public function profession2()
    {
        return $this->belongsTo(Profession::class,'profession2_id');
    }
}
