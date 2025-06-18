@extends('layouts.app', ['header' => true, 'footer' => true])

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="space-y-8">
            <!-- Header com informações da página -->
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <x-lucide-flame class="h-6 w-6 text-red-600" />
                    Meus Churrascos ({{ count($barbecues) }})
                </h1>
                <a href="{{ route('barbecues.create') }}"
                    class="inline-flex items-center bg-red-600 px-4 py-2 text-white rounded-lg group transition-all duration-300 hover:bg-red-700 hover:shadow-lg hover:shadow-red-600/30">
                    <x-lucide-plus class="h-4 w-4 mr-2" />
                    Criar Churrasco
                </a>
            </div>

            @if (count($barbecues) === 0)
                <!-- Card vazio quando não há churrascos -->
                <div class="border-2 border-dashed border-gray-200 rounded-xl">
                    <div class="text-center py-16">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                            <x-lucide-flame class="h-8 w-8 text-gray-400" />
                        </div>
                        <h4 class="text-lg font-medium text-gray-900 mb-2">Nenhum churrasco cadastrado</h4>
                        <p class="text-gray-500 mb-4">Adicione o primeiro churrasco para começar</p>
                        <a href="{{ route('barbecues.create') }}"
                            class="inline-flex items-center bg-red-600 px-4 py-2 text-white text-sm rounded-lg transition-all hover:bg-red-700">
                            <x-lucide-plus class="h-4 w-4 mr-2" />
                            Criar Churrasco
                        </a>
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
