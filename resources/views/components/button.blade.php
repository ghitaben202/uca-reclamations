<!-- resources/views/components/button.blade.php -->
@props(['type' => 'submit', 'class' => ''])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 ' . $class]) }}>
    {{ $slot }}
</button>
