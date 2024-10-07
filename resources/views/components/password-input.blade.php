@props(['label', 'name', 'required' => true, 'placeholder' => ''])

<div class="mb-6">
    <label class="block text-gray-700 text-sm mb-2" for="{{ $name }}">
        {{ $label }}
    </label>
    <input type="password" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
        class="border border-gray-300 rounded-lg w-full py-2 px-4 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500">
    <p class="text-gray-500 text-xs mt-2">Use oito ou mais caracteres com uma combinação de letras, números e
        símbolos</p>
</div>
