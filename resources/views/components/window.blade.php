    <div {{ $attributes->merge(['class' => 'py-12 mx-auto max-w-7xl']) }}>
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg card">
			  @if(isset($header))
				<div class="card-header !p-4">
					{{ $header }}
				</div>
			  @endif
			    <div class="card-body">
					{{ $slot }}
				</div>
            </div>
        </div>
    </div>