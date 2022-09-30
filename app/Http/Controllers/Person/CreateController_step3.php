<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Profession;

use Buglerv\LaravelHelpers\Eloquent\GroupEagerLoading;
use App\Models\WarcraftGroup;

class CreateController_step3 extends Controller
{
    public function create(Person $person)
    {
        GroupEagerLoading::loadTrashed($person,WarcraftGroup::class,[
            'race' => 'race_id',
            'warclass' => 'warclass_id',
        ]);
		
        $professions = Profession::all();

        return view('warcraft.person.create_step3',compact('person','professions'));
    }
    
    public function store(Request $request, Person $person)
    {
        $validated = $request->validate([
            'profession_id' => 'required|integer|exists:App\Models\Profession,id',
        ]);
        
        $person->profession1_id = $validated['profession_id'];
        $person->save();
        
        return redirect()->route('person.create',$person);
    }
}
