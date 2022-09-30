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
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@forelse($abilities as $ability)
				<tr>
					<td>
					    @if( $ability->feature->deleted_at )
						    <i class="fa fa-times text-red-600"></i>
						@endif
						<x-class-link :group="$ability->feature"/>
					</td>
					<td><x-ability-link :group="$ability"/></td>
					<td><x-description :group="$ability"/></td>
					<td>
						<a class="btn btn-sm btn-primary" href="{{ route('ability.edit',[$ability->feature_id,$ability]) }}">
							<i class="fa fa-pencil"></i>
						</a>
					</td>
					<td>
					  @if( $ability->deleted_at )
						<a class="btn btn-sm btn-success" href="{{ route('ability.restore',[$ability->feature_id,$ability]) }}">
							<i class="fa fa-pencil"></i>
						</a>
					  @else
						<form method="POST" action="{{ route('ability.destroy',[$ability->feature_id,$ability]) }}" style="display:inline-block;">
							@csrf
							@method('DELETE')
							<button class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Do you realy want to delete this ability?') }}')">
								<i class="fa fa-trash"></i>
							</button>
						</form>
					  @endif
					</td>
				</tr>
			@empty
				<tr>
					<td>{{ __('No abilities!') }}</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			@endforelse
			</tbody>
		</table>
    </x-window>
</x-app-layout>
