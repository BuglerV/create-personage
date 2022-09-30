<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\WarcraftGroup;
use Illuminate\Http\Request;
use App\Http\Requests\WarcraftGroupRequest;

class RaceController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('warcraft.group.index',[
		    'type' => 'race',
			'groups' => Race::withTrashedIfAdmin()->get(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warcraft.group.create',[
		    'action' => route('race.store'),
			'type' => 'race',
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\WarcraftGroupRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarcraftGroupRequest $request)
    {
        Race::create($request->validated());
        
        return redirect()->route('race.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Race  $race
     * @return \Illuminate\Http\Response
     */
    public function edit(Race $race)
    {
        return view('warcraft.group.edit',[
		    'type' => 'race',
			'group' => $race,
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\WarcraftGroupRequest $request
     * @param  \App\Models\Race  $race
     * @return \Illuminate\Http\Response
     */
    public function update(WarcraftGroupRequest $request, Race $race)
    {
        $race->fill($request->validated())->save();

        return redirect()->route('race.index');
    }
	
    /**
     * Restore the specified resource to storage.
     *
     * @param  \App\Models\Race $race
     * @return \Illuminate\Http\Response
     */
    public function restore(Race $race)
    {
        $race->restore();
        
        return redirect()->route('race.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Race  $race
     * @return \Illuminate\Http\Response
     */
    public function destroy(Race $race)
    {
        $race->delete();
        
        return redirect()->route('race.index');
    }
}
