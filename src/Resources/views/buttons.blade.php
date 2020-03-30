<?php /** @var array $button */ ?>
<?php /** @var array[] $options */ ?>

<div class="btn-group btn-group-sm">

    <a href="{{ $button['href'] ?? '#' }}" title="{{ $button['title'] }}" class="btn btn-{{$button['role'] ?? 'secondary'}}">
        @if($button['fa'] ?? false)<i class="{{$button['fa']}}" aria-hidden="true"></i>@endif
        {{ $button['label'] ?? '' }}
    </a>


    <button type="button" class="btn btn-{{$button['role'] ?? 'secondary'}} dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Lenyíló lista megnyitása</span>
    </button>
    <div class="dropdown-menu">
        @foreach($options as $option)
            @if(!($option['show'] ?? true)) @continue @endif

            <a href="{{ $option['href'] }}" class="dropdown-item @if(! ($option['can'] ?? true) ) disabled @endif {{$option['class'] ?? ''}}" title="{{$option['title'] ?? $option['label'] ?? ''}}" @if($option['post'] ?? false) onclick="$('#post-form').attr('action',this.href).submit();return false;"@endif>
                @if($option['fa'] ?? false) <i class="{{$option['fa']}}" aria-hidden="true"></i> @endif
                {{ $option['label'] ?? '' }}
            </a>
        @endforeach

    </div>
</div>
