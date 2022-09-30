<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('Ability',2) }}
        </h2>
    </x-slot>

    <x-window>
		<table class="table">
			<thead>
				<tr>
					<th></th>
					<th>{{ __('Title') }}</th>
					<th>{{ __('Description') }}</th>
				</tr>
			</thead>
			<tbody>
			@forelse($abilities as $ability)
				<tr>
					<td><x-class-link :group="$ability->feature"/></td>
					<td><x-ability-link :group="$ability"/></td>
					<td><x-description :group="$ability"/></td>
				</tr>
			@empty
				<tr>
					<td>{{ __('No abilities!') }}</td>
					<td></td>
					<td></td>
				</tr>
			@endforelse
			</tbody>
		</table>
    </x-window>
</x-app-layout>
