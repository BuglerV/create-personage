<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;

use Buglerv\LaravelHelpers\Eloquent\GroupEagerLoading;
use App\Models\WarcraftGroup;

class CreateController_step4 extends Controller
{
    public function create(Person $person)
    {
        GroupEagerLoading::loadTrashed($person,WarcraftGroup::class,[
            'race' => 'race_id',
            'warclass' => 'warclass_id',
            'profession1' => 'profession1_id',
        ]);
        
        return view('warcraft.person.create_step4',compact('person'));
    }
    
    public function store(Request $request, Person $person)
    {
        $person->status = 'active';
        $person->save();
        
        return redirect()->route('person.create',$person);
    }
}
