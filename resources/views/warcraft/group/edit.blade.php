<x-app-layout>
    <x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice(ucfirst($type),2) }}
        </h2>
    </x-slot>

    <x-window>
	    <x-slot name="header">
		    <x-back-link href="{{ session('from') }}"/>
			<x-class-link :group="$group" class="text-xl ml-4"/>
			<span class="text-sm text-gray-500 mx-4">
				{{ __('Update ' . $type) }}
			</span>
	    </x-slot>

		<form method="POST" action="{{ route($type . '.update',$group) }}">
			@csrf
			@method('PUT')

			<div class="row mb-3">
				<label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

				<div class="col-md-6">
					<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $group->title }}" required autocomplete="title" autofocus>

					@error('title')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>
			
			<div class="row mb-3">
				<label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

				<div class="col-md-6">
					<input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $group->description }}" autocomplete="description" autofocus>

					@error('description')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>
			
			<div class="row mb-3">
				<label for="color" class="col-md-4 col-form-label text-md-end">{{ __('Color') }}</label>

				<div class="col-md-6">
					<input id="color" type="color" class="form-control !py-0 !px-1 @error('color') is-invalid @enderror" name="color" value="{{ $group->color }}" required autocomplete="color" autofocus>

					@error('color')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>

			<div class="row mb-0">
				<div class="col-md-8 offset-md-4">
					<button type="submit" class="btn btn-primary">
						{{ __('Update') }}
					</button>
				</div>
			</div>
		</form>
    </x-window>
</x-app-layout>
