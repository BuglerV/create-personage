<div {{ $attributes }}>
    <div class="text-center">
        {{ __('stepper::messages.Step') }} {{ $options->step }}/{{ $options->steps }}
    </div>
    
    <!--<progress style="height:1.5em;" class="offset-md-1 col-md-10" value="{{ $percent / 100 }}"></progress>-->
    
    <div style="height:1em;" class="offset-md-1 col-md-10 rounded border border-green-900 bg-white">
        <div class="h-full bg-green-500" style="width:{{ $percent }}%"></div>
    </div>
</div>