<x-app-layout>
    <x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('Ability',2) }}
        </h2>
    </x-slot>

    <x-window>
	    <x-slot name="header">
		    <x-back-link :href="$backUrl"/>
			<x-class-link :group="$group" class="text-xl ml-4"/>
			<span class="text-sm text-gray-500 ml-4">
				{{ $group->description }}
			</span>
	    </x-slot>

		<table class="table">
			<thead>
				<tr>
					<th>{{ __('Title') }}</th>
					<th>{{ __('Description') }}</th>
				</tr>
			</thead>
			<tbody>
			@forelse($abilities as $ability)
				<tr>
					<td><x-ability-link :group="$ability"/></td>
					<td><x-description :group="$ability"/></td>
				</tr>
			@empty
				<tr>
					<td>{{ __('No abilities!') }}</td>
					<td></td>
				</tr>
			@endforelse
			</tbody>
		</table>
    </x-window>
</x-app-layout>
