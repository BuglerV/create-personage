<div class="mb-4">
	<x-class-link :group="$group" class="text-lg"/>
	<span class="mx-4"><x-description :group="$group"/></span>

	<div class="ml-6">
	  @forelse (($group->abilities) as $ability)
	    <div>
			<x-ability-link :group="$ability" class="text-lg"/>
			<span class="mx-4"><x-description :group="$ability"/></span>
		</div>
	  @empty
	  @endforelse
	</div>
</div>