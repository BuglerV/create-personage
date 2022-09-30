<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>

    <x-window>
		<table class="table">
			<thead>
				<tr>
					<th>{{ __('Name') }}</th>
					<th>{{ trans_choice('Race',1) }}</th>
					<th>{{ trans_choice('WarClass',1) }}</th>
					<th>{{ trans_choice('Profession',1) }}</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@forelse($people as $person)
				<tr>
					<td><x-person-link :group="$person" class="text-lg"/></td>
					
				  @if($person->race)
					<td><x-class-link :group="$person->race"/></td>
				  @else
					<td><i>{{ __('None') }}</i></td>
				  @endif
					
				  @if($person->warclass)
				    <td><x-class-link :group="$person->warclass"/></td>
				  @else
					<td><i>{{ __('None') }}</i></td>
				  @endif
					
				  @if($person->profession1)
				    <td><x-class-link :group="$person->profession1"/></td>
				  @else
					<td><i>{{ __('None') }}</i></td>
				  @endif
					
					<td>
						<form method="POST" action="{{ route('person.destroy',$person) }}" style="display:inline-block;">
							@csrf
							@method('DELETE')
							<button class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Do you realy want to delete this personage?') }}')">
								<i class="fa fa-trash"></i>
							</button>
						</form>
					</td>
				</tr>
			@empty
				<tr>
					<td>{{ __('No people!') }}</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			@endforelse
			</tbody>
		</table>
	  @unless ( $people->count() >= 3 )
		<form action="{{ route('person.init') }}" method="POST" class="mt-8">
			@csrf
			
			<div class="row mb-3">
				<label for="name" class="col-md-4 col-form-label text-right">{{ __('Name') }}</label>

				<div class="col-md-6">
					<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

					@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>
		
			<div class="row mb-0">
				<div class="col-md-8 offset-md-4">
					<button type="submit" class="btn btn-success">
						{{ __('Create new person') }}
					</button>
				</div>
			</div>
		</form>
	  @else
		<div>
		  {{ __('You need to delete one of your personages if you want to create another one.') }}
		</div>
	  @endunless
    </x-window>
</x-app-layout>
