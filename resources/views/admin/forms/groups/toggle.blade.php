@php
    $errorMessage = '<div class="invalid-feedback">' . $errors->first($name) . '</div>';
@endphp

@component('form::main-group')
    @slot('label', Form::label($name, $label, ['class' => 'mb-1 form-check-label mr-3 ml-0'], false))
    @slot('input_column', Form::checkbox($name, $value, $checked, array_merge(['class' => 'form-check-switch', 'rows' => 3], $attributes)))
    @slot('error_message', $errorMessage)
@endcomponent
