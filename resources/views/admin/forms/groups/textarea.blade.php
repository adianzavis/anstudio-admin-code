@php
    $errorMessage = '<div class="invalid-feedback">' . $errors->first($name) . '</div>';
@endphp

@component('form::main-group')
    @slot('label', Form::label($name, $label, ['class' => 'mb-1'], false))
    @slot('input_column', Form::textarea($name, $value, array_merge(['class' => 'form-control', 'rows' => 3], $attributes)))
    @slot('error_message', $errorMessage)
@endcomponent
