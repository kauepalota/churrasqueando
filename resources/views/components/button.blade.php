<button {{ $attributes->merge(['class' => 'bg-red-700 hover:bg-red-500 w-full text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline']) }}>
    {{ $slot }}
</button>
