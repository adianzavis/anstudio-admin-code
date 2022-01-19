@php
    $inputError = $errors->first($name);
    $errorMessage = '<div class="invalid-feedback">' . $inputError . '</div>';
@endphp

@component('form::main-group', ['inputError' => $inputError])
    @if ($label)
        @slot('label', Form::label($name, $label, ['class' => 'mb-1'], false))
    @endif
    @slot('input_column', Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)))
    @slot('error_message', $errorMessage)
@endcomponent
