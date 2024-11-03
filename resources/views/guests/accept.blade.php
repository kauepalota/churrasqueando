@extends('layouts.app', ['header' => true, 'footer' => true])

@php
    $formats = config('barbecue-formats')
@endphp

@section('title', 'Confirmar Presença')

@section('content')
    <div class="max-xl:px-6 max-w-7xl container mx-auto py-12">
        <h1 class="text-2xl font-bold mb-6">Confirmar Presença</h1>

        <div class="mb-4">
            <p>Participantes esperados: {{ $barbecue->participants }}</p>
            <p>Endereço: {{ $barbecue->address }}</p>
            <p>Data: {{ $barbecue->date }}</p>

            @php
                $formatTitle = 'Formato desconhecido'; // Default value

                foreach ($formats as $format) {
                    if ($format['value'] == $barbecue->format) {
                        $formatTitle = $format['title'];
                        break;
                    }
                }
            @endphp

            <p>Formato: {{ $formatTitle }}</p>
        </div>

        <form method="POST" action="{{ route('guests.store', $barbecue->id) }}">
            @csrf

            <x-input label="Nome" name="name" type="text" value="{{ old('name') }}"/>
            <x-input label="Email" name="email" type="email" value="{{ old('email') }}" />

            <div class="flex items-center justify-between mt-4">
                <x-button type="submit">Confirmar</x-button>
            </div>
        </form>
    </div>
@endsection
