<!-- resources/views/components/input.blade.php -->
@props(['type' => 'text', 'name', 'value' => '', 'placeholder' => '', 'class' => ''])

<input 
    type="{{ $type }}" 
    name="{{ $name }}" 
    value="{{ old($name, $value) }}" 
    placeholder="{{ $placeholder }}" 
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ' . $class]) }}
>
