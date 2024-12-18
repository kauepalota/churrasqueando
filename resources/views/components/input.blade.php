@props([
    'label',
    'type' => 'text',
    'name',
    'value' => '',
    'required' => true,
    'placeholder' => '',
    'readonly' => false,
])

<div class="mb-4">
    <label class="block text-gray-700 text-sm mb-2" for="{{ $name }}">
        {{ $label }}
    </label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline read-only:cursor-not-allowed read-only:opacity-50"
        @if ($required) required @endif @if ($readonly) readonly @endif>
    @error($name)
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>
