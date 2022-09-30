<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>

    <x-window class="">
	    <x-slot name="header">
		    <x-back-link href="{{ route('person.index') }}"/>
			<span class="text-sm text-gray-500 mx-4">
				{{ __('Person') }}
			</span>
			<x-person-link :group="$person" class="text-lg"/>
			</span>
	    </x-slot>
	    @include('warcraft.person.wargroup',['group' => $person->race])
	    @include('warcraft.person.wargroup',['group' => $person->warclass])
	    @include('warcraft.person.wargroup',['group' => $person->profession1])
    </x-window>
</x-app-layout>
