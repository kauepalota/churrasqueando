@extends('layouts.app', ['header' => true, 'footer' => true])

@section('title', 'Dashboard')

@php
    $radioOptions = config('barbecue-formats');
@endphp

@section('content')
    <div class="max-w-full mx-auto px-6 py-12">
        <div class="space-y-8">
            <!-- Header da página com saldo -->
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <x-lucide-flame class="h-6 w-6 text-red-600" />
                        Dashboard
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Bem-vindo ao Churrasqueando, {{ explode('@', $user->email)[0] }}!
                    </p>
                </div>
                
                <!-- Card de saldo -->
                <div class="flex items-center p-4 bg-white border rounded-xl shadow-sm hover:shadow transition-all" 
                     x-data="{ showDetails: false }">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-100 mr-4">
                        <x-lucide-wallet class="w-6 h-6 text-green-600" />
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-medium text-gray-500">Seu Saldo</p>
                            <button @click="showDetails = !showDetails" class="text-gray-400 hover:text-gray-600">
                                <x-lucide-info class="w-4 h-4" />
                            </button>
                        </div>
                        <p class="text-2xl font-bold text-gray-900">
                            R$ {{ number_format($user->balance, 2, ',', '.') }}
                        </p>
                        
                        <!-- Detalhes do saldo -->
                        <div x-show="showDetails" 
                             x-transition:enter="transition ease-out duration-200" 
                             x-transition:enter-start="opacity-0 scale-95" 
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute mt-2 right-6 bg-white border border-gray-200 rounded-lg shadow-lg p-4 z-50 w-72">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="font-semibold text-gray-800">Detalhes do Saldo</h3>
                                <button @click="showDetails = false" class="text-gray-400 hover:text-gray-600">
                                    <x-lucide-x class="w-4 h-4" />
                                </button>
                            </div>
                            <div class="space-y-2 text-sm">
                                <p class="flex justify-between">
                                    <span class="text-gray-600">Total recebido:</span>
                                    <span class="font-medium">R$ {{ number_format($user->balance * 100/95, 2, ',', '.') }}</span>
                                </p>
                                <p class="flex justify-between">
                                    <span class="text-gray-600">Taxa de serviço (5%):</span>
                                    <span class="font-medium text-red-600">-R$ {{ number_format($user->balance * 5/95, 2, ',', '.') }}</span>
                                </p>
                                <div class="border-t border-gray-100 my-2 pt-2">
                                    <p class="flex justify-between font-medium">
                                        <span>Saldo disponível:</span>
                                        <span class="text-green-600">R$ {{ number_format($user->balance, 2, ',', '.') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Cards de estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl border p-4 shadow-sm hover:shadow transition-all">
                    <div class="flex items-center space-x-4">
                        <div class="rounded-full p-2 bg-blue-100">
                            <x-lucide-calendar class="h-6 w-6 text-blue-600" />
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-500">Total de Churrascos</div>
                            <div class="text-xl font-semibold text-gray-900">{{ $barbecues->count() }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl border p-4 shadow-sm hover:shadow transition-all">
                    <div class="flex items-center space-x-4">
                        <div class="rounded-full p-2 bg-purple-100">
                            <x-lucide-users class="h-6 w-6 text-purple-600" />
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-500">Total de Convidados</div>
                            <div class="text-xl font-semibold text-gray-900">
                                {{ $barbecues->sum(function($bbq) { return $bbq->guests->count(); }) }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl border p-4 shadow-sm hover:shadow transition-all">
                    <div class="flex items-center space-x-4">
                        <div class="rounded-full p-2 bg-green-100">
                            <x-lucide-trending-up class="h-6 w-6 text-green-600" />
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-500">Próximo Churrasco</div>
                            <div class="text-xl font-semibold text-gray-900">
                                @php
                                    $nextBarbecues = $barbecues->filter(function($bbq) {
                                        return \Carbon\Carbon::parse($bbq->date)->greaterThanOrEqualTo(now());
                                    });
                                @endphp
                                
                                @if($nextBarbecues->count() > 0)
                                    {{ \Carbon\Carbon::parse($nextBarbecues->sortBy('date')->first()->date)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
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
