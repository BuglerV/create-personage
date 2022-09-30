<x-app-layout>
    <x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>

    <x-window class="w-2/3">
	    <x-slot name="header">
		    <x-back-link href="{{ route('person.index') }}"/>
			<span class="text-sm text-gray-500 mx-4">
				{{ __('Choose your race') }}
			</span>
	    </x-slot>
		
		<x-stepper-info :name="$person->name" class="mb-4"/>

		<form method="POST" action="{{ route('person.store',$person) }}">
			@csrf
			
			<div class="row text-2xl mb-5">
				<label class="col-md-4 text-right">{{ __('Name') }}:</label>

				<h2 class="col-md-6">
					<b>{{ $person->name }}</b>
				</h2>
			</div>

			  @foreach($races as $race)
			<div class="row mb-3">
				<div class="col-md-4 text-right">
					<input id="race_{{ $race->id }}" type="radio" class="col-form-label form-check-input" name="race_id" value="{{ $race->id }}" autocomplete="race">
				</div>

				<label for="race_{{ $race->id }}" class="col-md-6">
				  <div style="color:{{ $race->color }};">
					<b>{{ $race->title }}</b>
				  </div>
				  <div class="text-sm text-gray-500">
					{{ $race->description }}
				  </div>
				</label>
			</div>
			  @endforeach

			  @error('race')
				  <span class="invalid-feedback" role="alert">
					  <strong>{{ $message }}</strong>
				  </span>
			  @enderror

			<div class="row mb-0">
				<div class="col-md-8 offset-md-4">
					<button type="submit" class="btn btn-primary">
						{{ __('Confirm') }}
					</button>
				</div>
			</div>
		</form>
    </x-window>
</x-app-layout>
