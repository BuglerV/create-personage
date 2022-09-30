<x-guest-layout>
    <div class="w-screen h-screen bg-auto bg-no-repeat bg-center "
	     style="background: black url('/images/bg.jpg') center/auto 80% no-repeat padding-box;"
	>
        <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ route('person.index') }}" class="text-sm text-gray-200 dark:text-gray-500 underline">{{ __('On server') }}</a>
						<form method="POST" action="{{ route('logout') }}" x-data class="inline">
							@csrf
							<a href="{{ route('person.index') }}" @click.prevent="$root.submit();" class="text-sm text-gray-200 dark:text-gray-500 underline ml-4">{{ __('Log Out') }}</a>
						</form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-200 dark:text-gray-500 underline">{{ __('Login') }}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-200 dark:text-gray-500 underline">{{ __('Register') }}</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
	</div>
</x-guest-layout>