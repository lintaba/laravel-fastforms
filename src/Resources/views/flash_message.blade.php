@php($bs = ['error'=>'danger', 'flash_message'=>'info'];)

@foreach(['error', 'warning', 'info', 'success', 'flash_message'] as $key=>$type)
    @if ($message = Session::get($type))
        <div class="alert alert-{{$bs[$type] ?? $type}} alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            @if(is_array($message)) @php($message = implode(PHP_EOL,$message)) @endif
            <strong>{!! str_replace(["\r\n","\r","\n"], '<br>', e($message)) !!}</strong>

            @if ($actions = Session::get($type.'_action'))
                @foreach($actions as $label=>$action)
                    <a href="{{$action}}" class="btn btn-outline btn-sm mx-4 text-decoration-none">{{$label}}</a>
                @endforeach
            @endif
        </div>
    @endif
@endforeach
