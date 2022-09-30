<?php

namespace App\Http\Controllers;

use App\Models\WarClass;
use App\Models\WarcraftGroup;
use Illuminate\Http\Request;
use App\Http\Requests\WarcraftGroupRequest;

class WarClassController extends Controller
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
		    'type' => 'warclass',
			'groups' => WarClass::withTrashedIfAdmin()->get(),
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
		    'action' => route('warclass.store'),
			'type' => 'warclass',
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
        WarClass::create($request->validated());
        
        return redirect()->route('warclass.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarClass  $warclass
     * @return \Illuminate\Http\Response
     */
    public function edit(WarClass $warclass)
    {
        return view('warcraft.group.edit',[
		    'type' => 'warclass',
			'group' => $warclass,
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\WarcraftGroupRequest $request
     * @param  \App\Models\WarClass  $warclass
     * @return \Illuminate\Http\Response
     */
    public function update(WarcraftGroupRequest $request, WarClass $warclass)
    {
        $warclass->fill($request->validated())->save();

        return redirect()->route('warclass.index');
    }
	
    /**
     * Restore the specified resource to storage.
     *
     * @param  \App\Models\WarClass $warclass
     * @return \Illuminate\Http\Response
     */
    public function restore(WarClass $warclass)
    {
        $warclass->restore();
        
        return redirect()->route('warclass.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WarClass  $warclass
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarClass $warclass)
    {
        $warclass->delete();
        
        return redirect()->route('warclass.index');
    }
}
