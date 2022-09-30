<x-app-layout>
    <x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice(ucfirst($type),2) }}
        </h2>
    </x-slot>

    <x-window>
		<a href="{{ route($type . '.create') }}" class="btn btn-success mb-4">
		  {{ __('New ' . $type) }}
		</a>
		<table class="table">
			<thead>
				<tr>
					<th>{{ __('Title') }}</th>
					<th>{{ __('Description') }}</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@forelse($groups as $group)
				<tr>
					<td>
					    @if( $group->deleted_at )
						    <i class="fa fa-times text-red-600"></i>
						@endif
						<x-class-link :group="$group"/>
					</td>
					<td><x-description :group="$group"/></td>
					<td>
						<a class="btn btn-sm btn-primary" href="{{ route($type . '.edit',$group) }}">
							<i class="fa fa-pencil"></i>
						</a>
					</td>
					<td>
					  @if( $group->deleted_at )
						<a class="btn btn-sm btn-success" href="{{ route($type . '.restore',$group) }}">
							<i class="fa fa-level-up"></i>
						</a>
					  @else
						<form method="POST" action="{{ route($type . '.destroy',$group) }}" style="display:inline-block;">
							@csrf
							@method('DELETE')
							<button class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Do you realy want to delete this ' . $type . '?') }}')">
								<i class="fa fa-level-down"></i>
							</button>
						</form>
					  @endif
					</td>
				</tr>
			@empty
				<tr>
					<td>{{ __('Nothing here!') }}</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			@endforelse
			</tbody>
		</table>
    </x-window>
</x-app-layout>