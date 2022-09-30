<span {{ $attributes }}>
    <a href="{{ route('person.show',$group) }}">
	  @if($group->status == 'creating')
		  <i class="fa fa-check text-red-600"></i>
	  @endif
      <b>{{ $group->name }}</b>
    </a>
</span>