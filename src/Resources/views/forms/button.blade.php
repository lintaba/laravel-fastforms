<div class="form-group row @if(($if ?? false) && null === data_get($item, $if)) d-none @endif " @if($if ?? false)data-if="{{$if}}"@endif>
    <div class="col-md-8 offset-md-2">
        <button type="button" id="{{$button}}" class="{{$class ?? ''}} btn btn-{{$role ?? 'default'}} button-{{$button}}" title="{{trans($tag.$button.'.title') }}">
            @if($fa ?? false)<i class="fas fa-{{$fa}}"></i>@endif
            {{trans($tag.$button.'.label') }}
        </button>
    </div>
</div>
