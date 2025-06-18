@extends('layouts.app', ['header' => true, 'footer' => true])

@section('title', 'Criar Churrasco')

@php
    $radioOptions = config('barbecue-formats');
@endphp

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="space-y-8">
            <!-- Header com título da página -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <x-lucide-plus class="h-6 w-6 text-red-600" />
                        Adicionar Novo Churrasco
                    </h1>
                    <p class="text-gray-500 mt-1">
                        Preencha as informações abaixo para criar seu churrasco
                    </p>
                </div>
                <a href="{{ route('barbecues.index') }}"
                    class="inline-flex items-center text-gray-600 hover:text-red-600 transition-colors">
                    <x-lucide-arrow-left class="h-4 w-4 mr-1" />
                    Voltar para lista
                </a>
            </div>

            <!-- Formulário de criação de churrasco -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                <!-- Painel de informações/imagem -->
                <div
                    class="bg-gradient-to-br from-red-500 to-red-700 text-white rounded-xl p-8 shadow-lg overflow-hidden relative">
                    <div class="absolute right-0 bottom-0 opacity-10">
                        <x-lucide-flame class="h-64 w-64" />
                    </div>
                    <div class="relative z-10 space-y-8">
                        <div>
                            <h2 class="text-3xl font-bold mb-2">Organize seu churrasco perfeito</h2>
                            <p class="text-red-100 max-w-md">
                                Com o Churrasqueando você planeja eventos memoráveis, gerencia convidados, acompanha
                                pagamentos e muito mais.
                            </p>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                    <x-lucide-users class="h-5 w-5" />
                                </div>
                                <div>
                                    <h3 class="font-medium">Gerenciamento de convidados</h3>
                                    <p class="text-sm text-red-100">Envie convites e acompanhe confirmações</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                    <x-lucide-credit-card class="h-5 w-5" />
                                </div>
                                <div>
                                    <h3 class="font-medium">Controle de pagamentos</h3>
                                    <p class="text-sm text-red-100">Acompanhe quem já contribuiu e quanto falta</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                    <x-lucide-utensils class="h-5 w-5" />
                                </div>
                                <div>
                                    <h3 class="font-medium">Sugestões de quantidades</h3>
                                    <p class="text-sm text-red-100">Receba recomendações baseadas no número de convidados
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulário -->
                <div class="border border-gray-200 rounded-xl bg-white shadow-sm p-8">
                    <form method="POST" action="{{ route('barbecues.store') }}" class="space-y-6">
                        @csrf

                        <div class="space-y-2">
                            <label for="participants" class="text-sm font-medium text-gray-700">
                                Número de participantes
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <x-lucide-users class="h-5 w-5 text-gray-400" />
                                </div>
                                <input type="number" name="participants" id="participants"
                                    class="pl-10 block w-full rounded-lg border border-gray-300 py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                    placeholder="10" min="1" required value="{{ old('participants') }}">
                            </div>
                            @error('participants')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="address" class="text-sm font-medium text-gray-700">
                                Endereço do evento
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <x-lucide-map-pin class="h-5 w-5 text-gray-400" />
                                </div>
                                <input type="text" name="address" id="address"
                                    class="pl-10 block w-full rounded-lg border border-gray-300 py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                    placeholder="Rua Rio de Janeiro, 200" required value="{{ old('address') }}">
                            </div>
                            @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Data e Hora -->
                        <div class="space-y-2">
                            <label for="date" class="text-sm font-medium text-gray-700">
                                Data e hora
                            </label>
                            <x-date-picker id="date" name="date" />
                            @error('date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Formato do Churrasco -->
                        <div class="space-y-2">
                            <label for="format" class="text-sm font-medium text-gray-700">
                                Formato do churrasco
                            </label>

                            <div class="grid gap-3">
                                @foreach ($radioOptions as $option)
                                    <div
                                        class="relative rounded-lg border border-gray-200 hover:border-red-400 transition-colors">
                                        <input type="radio" name="format" id="format_{{ $option['value'] }}"
                                            value="{{ $option['value'] }}" class="peer hidden" required
                                            {{ old('format') == $option['value'] ? 'checked' : '' }}
                                            {{ !old('format') && $loop->first ? 'checked' : '' }}>
                                        <label for="format_{{ $option['value'] }}"
                                            class="block p-4 cursor-pointer rounded-lg peer-checked:border-red-500 peer-checked:ring-2 peer-checked:ring-red-500">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0 mr-3 mt-0.5">
                                                    <div
                                                        class="w-5 h-5 border border-gray-300 peer-checked:border-red-500 peer-checked:bg-red-500 rounded-full flex items-center justify-center">
                                                        <div class="peer-checked:bg-white w-2.5 h-2.5 rounded-full"></div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h3 class="text-base font-medium text-gray-900">{{ $option['title'] }}
                                                    </h3>
                                                    <p class="text-sm text-gray-500">{{ $option['description'] }}</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('format')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botão de submissão -->
                        <div class="pt-4">
                            <button type="submit"
                                class="w-full flex justify-center items-center bg-red-600 text-white py-3 px-4 rounded-lg hover:bg-red-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <x-lucide-flame class="h-5 w-5 mr-2" />
                                Criar Churrasco
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
