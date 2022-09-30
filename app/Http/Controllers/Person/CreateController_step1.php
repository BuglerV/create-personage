<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Race;

class CreateController_step1 extends Controller
{
    public function create(Person $person)
    {
        $races = Race::all();
        return view('warcraft.person.create_step1',[
            'person' => $person,
            'races' => $races,
        ]);
    }
    
    public function store(Request $request, Person $person)
    {
        $validated = $request->validate([
            'race_id' => 'required|integer|exists:App\Models\Race,id',
        ]);
        
        $person->race_id = $validated['race_id'];
        $person->save();
        
        return redirect()->route('person.create',$person);
    }
}
