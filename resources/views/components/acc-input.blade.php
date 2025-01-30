@props([
    'model',
    'type' => 'text',
    'class' => 'form-control',
    'placeholder' => 'Input',
    'rows' => 5,
])

@if($type == 'select')
    <select
        name="{{ $model }}"
        id="input-{{ $model }}"
        class="{{ $class }} @error($model) is-invalid @enderror" {!! $attributes !!}>
        {{ $slot }}
    </select>

@elseif($type == 'textarea')
    <textarea
        name="{{ $model }}"
        id="input-{{ $model }}"
        class="{{ $class }} @error($model) is-invalid @enderror"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}" {!! $attributes !!}></textarea>

@else
    <input
        name="{{ $model }}"
        id="input-{{ $model }}"
        type="{{ $type }}"
        class="{{ $class }} @error($model) is-invalid @enderror"
        placeholder="{{ $placeholder }}" {!! $attributes !!} />

@endif

<x-acc-input-error for="{{ $model }}" />
