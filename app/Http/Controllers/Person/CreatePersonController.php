<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;

use Illuminate\Support\Facades\DB;

use Facades\Buglerv\Stepper\Stepper;
use App\Http\Controllers\Person\CreateController;

class CreatePersonController extends Controller
{
    /**
     * Get the map of resource methods to ability names.
     *
     * @redefine traits method
     *   Illuminate\Foundation\Auth\Access\AuthorizesRequests::resourceAbilityMap()
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'create' => 'isMine',
            'store' => 'isMine',
            'init' => 'create',
            'back' => 'isMine',
        ];
    }
    
    /**
     * Get the list of resource methods which do not have model parameters.
     *
     * @return array
     */
    protected function resourceMethodsWithoutModels()
    {
        return ['init'];
    }
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Person::class);
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function create(Person $person)
    {
        return Stepper::get($person->name)->create($person);
    }
    
    /**
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function back(Person $person)
    {
        Stepper::back($person->name);
        
        return redirect()->route('person.create',$person);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Person $person)
    {
        $responce = Stepper::get($person->name)->store($request,$person);
        
        return Stepper::forwardOrRemoveAndFalse($person->name)
                  ? $responce
                  : redirect()->route('person.index');
    }

    /**
     * Init a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function init(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:people,name',
        ]);
        
        DB::beginTransaction();
            $person = Person::create($validatedData + [
                'user_id' => auth()->id(),
            ]);
            
            Stepper::init($person->name,CreateController::class);
        DB::commit();
        
        return redirect()->route('person.create',[$person->id]);
    }
}
