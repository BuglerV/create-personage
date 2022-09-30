<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\WarClass;

use Buglerv\LaravelHelpers\Eloquent\GroupEagerLoading;
use App\Models\WarcraftGroup;

class CreateController_step2 extends Controller
{
    public function create(Person $person)
    {
        GroupEagerLoading::loadTrashed($person,WarcraftGroup::class,[
            'race' => 'race_id',
        ]);
		
        $warclasses = WarClass::all();
        
        return view('warcraft.person.create_step2',compact('person','warclasses'));
    }
    
    public function store(Request $request, Person $person)
    {
        $validated = $request->validate([
            'warclass_id' => 'required|integer|exists:App\Models\WarClass,id',
        ]);
        
        $person->warclass_id = $validated['warclass_id'];
        $person->save();
        
        return redirect()->route('person.create',$person);
    }
}
