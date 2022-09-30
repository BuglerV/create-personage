<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class WarcraftGroupRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		$unique = Rule::unique('warcraft_group');
		
		if(Str::endsWith(Route::currentRouteName(),'.update')){
			$parameter = Route::current()->parameterNames[0];
			$ignore = Route::current()->$parameter;
			$unique->ignore($ignore);
		}
		
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                $unique,
            ],
            'description' => 'nullable|string',
            'color' => 'required|string|regex:/^#[0-9a-fA-F]{6}$/',
        ];
    }
}
