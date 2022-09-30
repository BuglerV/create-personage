<x-app-layout>
    <x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>

    <x-window class="w-2/3">
	    <x-slot name="header">
		    <x-back-link href="{{ route('person.back',$person) }}"/>
			<span class="text-sm text-gray-500 mx-4">
				{{ __('Confirm your personage') }}
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
			
			<div class="row text-2xl mb-5">
				<label class="col-md-4 text-right">{{ trans_choice('Race',1) }}:</label>
				<x-class-link :group="$person->race" class="col-md-6"/>
			</div>
			
			<div class="row text-2xl mb-5">
				<label class="col-md-4 text-right">{{ trans_choice('WarClass',1) }}:</label>
				<x-class-link :group="$person->warclass" class="col-md-6"/>
			</div>
			
			<div class="row text-2xl mb-5">
				<label class="col-md-4 text-right">{{ trans_choice('Profession',1) }}:</label>
				<x-class-link :group="$person->profession1" class="col-md-6"/>
			</div>

			<div class="row mb-0">
				<div class="col-md-8 offset-md-4">
					<button type="submit" class="btn btn-primary">
						{{ __('Create') }}
					</button>
				</div>
			</div>
		</form>
    </x-window>
</x-app-layout>
