<span {{ $attributes }}>
    <a href="{{ route('ability.index',$group->id) }}">
      <b style="color:{{ $group->color }};">{{ $group->title }}</b>
    </a>
</span>