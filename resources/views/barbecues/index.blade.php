@extends('layouts.app', ['header' => true, 'footer' => true])

@section('title', 'Dashboard')

@php
    $radioOptions = config('barbecue-formats');
@endphp

@section('content')
    <div class="max-w-full mx-auto px-6 py-12">
        <div class="space-y-8">
            <!-- Card para adicionar novo churrasco -->
            <div class="border-dashed border-2 border-gray-200 hover:border-red-300 transition-colors rounded-xl bg-white">
                <div class="p-6" x-data="{ showForm: false }">
                    <div class="flex items-center gap-3 mb-4 cursor-pointer" @click="showForm = !showForm">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                            <x-lucide-plus class="h-5 w-5 text-red-600" />
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 flex items-center gap-2">
                                Adicionar Novo Churrasco
                            </h4>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-gray-100">
                        <form method="POST" action="{{ route('barbecues.store') }}" class="space-y-4">
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

                            <div class="space-y-2">
                                <label for="format" class="text-sm font-medium text-gray-700">
                                    Formato do churrasco
                                </label>
                                <x-radio-group required :options="$radioOptions" name="format" />
                            </div>

                            <!-- Botão de submissão -->
                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full flex justify-center items-center bg-red-600 text-white py-2.5 px-4 rounded-lg hover:bg-red-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <x-lucide-flame class="h-5 w-5 mr-2" />
                                    Criar Churrasco
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Título da seção de lista -->
            <div class="flex items-center justify-between pt-4">
                <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                    <x-lucide-list class="h-5 w-5 text-red-600" />
                    Lista de Churrascos
                </h2>
                @if (count($barbecues) > 0)
                    <p class="text-sm text-gray-500">
                        Total: {{ count($barbecues) }} churrasco(s)
                    </p>
                @endif
            </div>

            @if (count($barbecues) === 0)
                <!-- Card vazio quando não há churrascos -->
                <div class="border-2 border-dashed border-gray-200 rounded-xl">
                    <div class="text-center py-16">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                            <x-lucide-flame class="h-8 w-8 text-gray-400" />
                        </div>
                        <h4 class="text-lg font-medium text-gray-900 mb-2">Nenhum churrasco cadastrado</h4>
                        <p class="text-gray-500 mb-4">Adicione seu primeiro churrasco usando o formulário acima</p>
                    </div>
                </div>
            @else
                <!-- Grid de cards de churrascos -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($barbecues as $barbecue)
                        <div
                            class="group hover:shadow-lg transition-all duration-200 border border-gray-200 bg-white rounded-xl overflow-hidden hover:border-red-500">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                            @if ($barbecue->format === 'bring_your_own')
                                                <x-lucide-utensils class="h-5 w-5 text-red-600" />
                                            @elseif($barbecue->format === 'split_equally')
                                                <x-lucide-split class="h-5 w-5 text-red-600" />
                                            @else
                                                <x-lucide-chef-hat class="h-5 w-5 text-red-600" />
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">Churrasco
                                                <span class="text-gray-500 text-sm">
                                                    ({{ $barbecue->participants }} participantes)
                                                </span>
                                            </h3>
                                            <p class="text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($barbecue->date)->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('barbecues.edit', $barbecue->id) }}"
                                            class="text-red-600 hover:text-red-700 p-1 rounded-full hover:bg-red-50">
                                            <x-lucide-edit-3 class="h-5 w-5" />
                                        </a>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-4 pt-4 border-t border-gray-100">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mt-0.5">
                                            <x-lucide-map-pin class="h-4 w-4 text-gray-500" />
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">
                                                Local
                                            </p>
                                            <p class="text-sm text-gray-900 leading-relaxed">{{ $barbecue->address }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mt-0.5">
                                            <x-lucide-users class="h-4 w-4 text-gray-500" />
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">
                                                Convidados
                                            </p>
                                            <p class="text-sm text-gray-900">
                                                {{ $barbecue->guests->count() }} de {{ $barbecue->participants }}
                                                confirmados
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mt-0.5">
                                            <x-lucide-tag class="h-4 w-4 text-gray-500" />
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">
                                                Formato
                                            </p>
                                            <p class="text-sm text-gray-900">
                                                @foreach (config('barbecue-formats') as $format)
                                                    @if ($format['value'] === $barbecue->format)
                                                        {{ $format['title'] }}
                                                    @endif
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <a href="{{ route('barbecues.edit', $barbecue->id) }}"
                                        class="inline-flex w-full items-center justify-center text-center bg-gray-100 py-2 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium">
                                        Ver detalhes
                                        <x-lucide-arrow-right class="h-4 w-4 ml-1.5" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
