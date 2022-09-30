<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
    /**
     * Authorize a resource action based on the incoming request.
     *
     * @param  string|array  $model
     * @return void
     */
    public function denyForUsers($model)
    {
		$methods = [...$this->denyForUsersMethods(), ...$this->denyForUsersMethodsMerged()];

        $this->middleware("can:deny,{$model}")->only($methods);
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function denyForUsersMethods()
    {
        return [
            'create',
            'store',
            'edit',
            'update',
            'restore',
            'destroy',
            'forceDelete',
        ];
    }

    /**
     * @return array
     */
    protected function denyForUsersMethodsMerged()
    {
        return [];
    }
}
