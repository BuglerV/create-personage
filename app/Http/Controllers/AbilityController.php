<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\WarcraftGroup;
use Illuminate\Http\Request;
use App\Http\Requests\WarcraftGroupRequest;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Buglerv\LaravelHelpers\Eloquent\GroupEagerLoading;

class AbilityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->denyForUsers(WarcraftGroup::class);
    }
	
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
		$group = WarcraftGroup::withTrashed()->findOrFail($id);
		
        $abilities = Ability::where('feature_id',$group->id)->get();
		
		$type = $group->group_type::$routeNamePrefix;
		
        //$backUrl = route($group->group_type::$routeNamePrefix . '.index');
        $backUrl = session('from');
        
        return view('warcraft.ability.index',compact(['group','abilities','backUrl','type']));
    }
    
    /**
     * Display a listing of abilities.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $abilities = Ability::hasNotForAdmin('feature')->orderBy('feature_id')->get();
		
        GroupEagerLoading::loadTrashed($abilities,WarcraftGroup::class,[
            'feature' => 'feature_id',
        ]);
		
        return view('warcraft.ability.list',[
            'abilities' => $abilities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\WarcraftGroup  $group
     * @return \Illuminate\Http\Response
     */
    public function create(WarcraftGroup $group)
    {
        return view('warcraft.ability.create',compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\WarcraftGroupRequest $request
     * @param  \App\Models\WarcraftGroup  $group
     * @return \Illuminate\Http\Response
     */
    public function store(WarcraftGroupRequest $request, WarcraftGroup $group)
    {
        $group->abilities()->create($request->validated() + [
            'feature_type' => $group->group_type,
        ]);
        
        return redirect()->route('ability.index',$group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarcraftGroup  $group
     * @param  \App\Models\Ability  $ability
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, WarcraftGroup $group, Ability $ability)
    {
        return view('warcraft.ability.edit',compact('group','ability'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\WarcraftGroupRequest $request
     * @param  \App\Models\WarcraftGroup  $group
     * @param  \App\Models\Ability  $ability
     * @return \Illuminate\Http\Response
     */
    public function update(WarcraftGroupRequest $request, WarcraftGroup $group, Ability $ability)
    {
        $ability->fill($request->validated() + [
            'feature_type' => $group->group_type,
        ])->save();

        return session('from')
            ? redirect(session('from'))
            : redirect()->route('ability.index',$group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WarcraftGroup  $group
     * @param  \App\Models\Ability  $ability
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarcraftGroup $group, Ability $ability)
    {
        $ability->delete();
        
        return back();
    }
}
