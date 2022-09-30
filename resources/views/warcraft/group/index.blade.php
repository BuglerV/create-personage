<x-app-layout>
    <x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice(ucfirst($type),2) }}
        </h2>
    </x-slot>

    <x-window>
		<table class="table">
			<thead>
				<tr>
					<th>{{ __('Title') }}</th>
					<th>{{ __('Description') }}</th>
				</tr>
			</thead>
			<tbody>
			@forelse($groups as $group)
				<tr>
					<td><x-class-link :group="$group"/></td>
					<td><x-description :group="$group"/></td>
				</tr>
			@empty
				<tr>
					<td>{{ __('Nothing here!') }}</td>
					<td></td>
				</tr>
			@endforelse
			</tbody>
		</table>
    </x-window>
</x-app-layout>