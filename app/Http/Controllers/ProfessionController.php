<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\WarcraftGroup;
use Illuminate\Http\Request;
use App\Http\Requests\WarcraftGroupRequest;

class ProfessionController extends Controller
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
		    'type' => 'profession',
			'groups' => Profession::withTrashedIfAdmin()->get(),
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
		    'action' => route('profession.store'),
			'type' => 'profession',
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
        Profession::create($request->validated());
        
        return redirect()->route('profession.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function edit(Profession $profession)
    {
        return view('warcraft.group.edit',[
		    'type' => 'profession',
			'group' => $profession,
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\WarcraftGroupRequest $request
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function update(WarcraftGroupRequest $request, Profession $profession)
    {
        $profession->fill($request->validated())->save();

        return redirect()->route('profession.index');
    }
	
    /**
     * Restore the specified resource to storage.
     *
     * @param  \App\Models\Profession $profession
     * @return \Illuminate\Http\Response
     */
    public function restore(Profession $profession)
    {
        $profession->restore();
        
        return redirect()->route('profession.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profession $profession)
    {
        $profession->delete();
        
        return redirect()->route('profession.index');
    }
}
