@props(['label', 'type' => 'text', 'name', 'value' => '', 'required' => true, 'placeholder' => ''])

<div class="mb-4">
    <label class="block text-gray-700 text-sm mb-2" for="{{ $name }}">
        {{ $label }}
    </label>
    <div class="w-full mx-auto">
        <textarea id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}" x-data="{
            resize() {
                $el.style.minHeight = '80px'
                $el.style.height = '0px';
                $el.style.height = $el.scrollHeight + 'px'
            }
        }" x-init="resize()" @input="resize()" type="text"
            placeholder="{{ $placeholder }}" @if ($required) required @endif
            class="flex w-full h-auto min-h-[80px] px-3 py-2 bg-white border rounded-md border-neutral-300 ring-offset-background text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
    </div>

    @error($name)
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>
