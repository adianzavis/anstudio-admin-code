<div class="flex flex-col @if($inputError ?? false) {{ 'has-error' }} @endif">
        {{ $label ?? null }}
        {!! $input_column !!}
        <small class="text-red-300 mt-1">{!! $error_message !!}</small>
</div>
