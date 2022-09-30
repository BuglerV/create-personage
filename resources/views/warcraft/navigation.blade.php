<x-jet-nav-link href="{{ route('person.index') }}" :active="request()->routeIs('person.index')">
	{{ __('People') }}
</x-jet-nav-link>

@if(true)
<x-jet-nav-link href="{{ route('race.index') }}" :active="request()->routeIs('race.index')">
	{{ trans_choice('Race',2) }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('warclass.index') }}" :active="request()->routeIs('warclass.index')">
	{{ trans_choice('WarClass',2) }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('profession.index') }}" :active="request()->routeIs('profession.index')">
	{{ trans_choice('Profession',2) }}
</x-jet-nav-link>
<x-jet-nav-link href="{{ route('ability.list') }}" :active="request()->routeIs('ability.list')">
	{{ trans_choice('Ability',2) }}
</x-jet-nav-link>
@else
<div class="inline-flex items-center">
	<x-jet-dropdown align="right" width="60">
		<x-slot name="trigger">
			<span class="inline-flex rounded-md">
				<button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
					{{ __('WarCraft') }}
					<svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
						<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
					</svg>
				</button>
			</span>
		</x-slot>

		<x-slot name="content">
			<div class="">
				<div class="dropdown-menu dropdown-menu-end flex flex-col" aria-labelledby="navbarDropdown">
					<x-jet-dropdown-link href="{{ route('race.index') }}">
						{{ trans_choice('Race',2) }}
					</x-jet-dropdown-link>
					<x-jet-dropdown-link href="{{ route('warclass.index') }}">
						{{ trans_choice('WarClass',2) }}
					</x-jet-dropdown-link>
					<x-jet-dropdown-link href="{{ route('profession.index') }}">
						{{ trans_choice('Profession',2) }}
					</x-jet-dropdown-link>
					<x-jet-dropdown-link href="{{ route('ability.list') }}">
						{{ trans_choice('Ability',2) }}
					</x-jet-dropdown-link>
				</div>
			</div>
		</x-slot>
	</x-jet-dropdown>
</div>
@endif