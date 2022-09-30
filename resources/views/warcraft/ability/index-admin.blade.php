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

        <div class="mb-4">
			<div class="float-right">
				<a href="{{ route($type . '.edit',$group) }}" class="btn btn-primary">
					{{ $group->title }} <i class="fa fa-pencil"></i>
				</a>
				  @if( $group->deleted_at )
					<a class="btn btn-success" href="{{ route($type . '.restore',$group) }}">
				        {{ $group->title }}
						<i class="fa fa-level-up"></i>
					</a>
				  @else
					<form method="POST" action="{{ route($type . '.destroy',$group) }}" style="display:inline-block;">
						@csrf
						@method('DELETE')
						<button class="btn btn-danger" onclick="return confirm('{{ __('Do you realy want to delete this ' . $type . '?') }}')">
							{{ $group->title }}
							<i class="fa fa-level-down"></i>
						</button>
					</form>
				  @endif
			</div>
			<div class="">
				<a href="{{ route('ability.create',$group) }}" class="btn btn-success">
				  {{ __('Create new ability') }}
				</a>
			</div>
		</div>

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
			@forelse($abilities as $ability)
				<tr>
					<td><x-ability-link :group="$ability"/></td>
					<td><x-description :group="$ability"/></td>
					<td>
						<a class="btn btn-sm btn-primary" href="{{ route('ability.edit',[$group,$ability]) }}">
							<i class="fa fa-pencil"></i>
						</a>
					</td>
					<td>
						<form method="POST" action="{{ route('ability.destroy',[$group,$ability]) }}" style="display:inline-block;">
							@csrf
							@method('DELETE')
							<button class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Do you realy want to delete this ability?') }}')">
								<i class="fa fa-trash"></i>
							</button>
						</form>
					</td>
				</tr>
			@empty
				<tr>
					<td>{{ __('No abilities!') }}</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			@endforelse
			</tbody>
		</table>
    </x-window>
</x-app-layout>
