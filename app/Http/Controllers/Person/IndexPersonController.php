<?php

namespace App\Http\Controllers\Person;

use App\Models\WarcraftGroup;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;
use Buglerv\LaravelHelpers\Eloquent\GroupEagerLoading;

class IndexPersonController extends Controller
{
    /**
     * Get the map of resource methods to ability names.
     *
     * @redefine traits method
     *   Illuminate\Foundation\Auth\Access\AuthorizesRequests::resourceAbilityMap
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'index' => 'viewAny',
            'show' => 'view',
            'destroy' => 'delete',
        ];
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = Person::where('user_id',Auth()->id())
                        ->get();
                        
        GroupEagerLoading::loadTrashed($people,WarcraftGroup::class,[
            'race' => 'race_id',
            'warclass' => 'warclass_id',
            'profession1' => 'profession1_id',
        ]);
        
        return view('warcraft.person.index',compact('people'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        if($person->status == 'creating' AND Gate::allows('isMine',$person)){
            return redirect()->route('person.create',$person);
        }
        
        GroupEagerLoading::loadTrashedWith($person,WarcraftGroup::class,[
            'race' => 'race_id',
            'warclass' => 'warclass_id',
            'profession1' => 'profession1_id',
        ],'abilities');
		
		return view('warcraft.person.show',compact('person'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();
        
        return redirect()->route('person.index');
    }
}
