@extends('layouts.app', ['header' => true, 'footer' => true])

@php
    $formats = config('barbecue-formats')
@endphp

@section('title', 'Confirmar Presença')

@section('content')
    <div class="min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-10">
                <div class="text-center mb-10">
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Confirmar Presença</h1>
                    <p class="text-gray-600">Estamos ansiosos para ter você conosco!</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10 p-6 bg-orange-50 rounded-xl">
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                            <p class="text-gray-700">{{ $barbecue->participants }} participantes esperados</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-gray-700">{{ $barbecue->address }}</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-gray-700">{{ $barbecue->date }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                            </svg>
                            @php
                                $formatTitle = 'Formato desconhecido';
                                foreach ($formats as $format) {
                                    if ($format['value'] == $barbecue->format) {
                                        $formatTitle = $format['title'];
                                        break;
                                    }
                                }
                            @endphp
                            <p class="text-gray-700">{{ $formatTitle }}</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('guests.store', $barbecue->id) }}" class="space-y-6">
                    @csrf
                    <div class="space-y-4">
                        <x-input placeholder="Seu nome" label="Nome" name="name" type="text" value="{{ old('name') }}"/>
                        <x-input placeholder="seumelhoremail@gmail.com" label="Email" name="email" type="email" value="{{ old('email') }}" />
                    </div>

                    <div class="flex justify-end">
                        <x-button type="submit">Confirmar</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
