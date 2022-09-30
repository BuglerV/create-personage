<?php
 
namespace App\View\Creators;
 
use App\Repositories\UserRepository;
use Illuminate\View\View;
 
class AdminCreator
{
    /**
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function create(View $view)
    {
		if(auth()->user()->can('admin')){
			$view->setPath(str_replace('.blade.php','-admin.blade.php',$view->getPath()));
		}
    }
}