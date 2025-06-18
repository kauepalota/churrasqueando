@extends('layouts.app', ['header' => true, 'footer' => true])

@section('title', 'Churrasqueando')

@section('content')
    <div class="mt-16 max-xl:px-8 container max-w-7xl mx-auto flex flex-col lg:flex-row items-center justify-between gap-16">
        <div class="lg:w-1/2 space-y-8">
            <h1 class="text-5xl font-bold leading-tight text-gray-800">
                <span class="text-red-700">Organize</span> Seu Churrasco Perfeito com Facilidade
            </h1>
            <p class="text-lg text-gray-600 max-w-lg">
                Churrasqueando simplifica o planejamento do seu churrasco.
                Gerencie convidados, custos e cardápios em um só lugar.
            </p>

            <a class="whitespace-nowrap max-w-min flex items-center bg-red-700 px-6 py-3 text-white rounded-3xl group transition-all duration-300 hover:bg-red-600 hover:shadow-lg hover:shadow-red-700/30"
                href="{{ route('barbecues.create') }}">
                Criar churrasco
                <x-lucide-chevron-right class="size-4 ml-1.5 group-hover:hidden" />
                <x-lucide-arrow-right class="size-4 ml-1.5 hidden group-hover:inline-block" />
            </a>
        </div>
        <div class="lg:w-1/2 shadow-2xl shadow-gray-300/50 rounded-xl overflow-hidden">
            <img class="object-cover w-full hover:scale-105 transition-transform duration-700" alt="Barbecue"
                src={{ asset('svg/barbecue.svg') }}>
        </div>
    </div>

    <div class="w-full bg-gradient-to-b from-white to-gray-50 mt-24 py-24">
        <div class="max-xl:px-8 container space-y-24 max-w-7xl mx-auto">
            <div class="flex flex-col items-center justify-between gap-16 lg:flex-row">
                <div class="lg:w-1/2 order-2 lg:order-1 shadow-2xl shadow-gray-300/50 rounded-xl overflow-hidden">
                    <img class="object-cover w-full hover:scale-105 transition-transform duration-700"
                        alt="Confirmação de pagamento" src={{ asset('svg/payment.svg') }}>
                </div>
                <div class="lg:w-1/2 space-y-8 order-1 lg:order-2">
                    <h2 class="text-4xl font-bold leading-tight text-gray-800">
                        Confirmação de presença e <span class="text-red-700">pagamentos</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-lg">
                        Os participantes podem confirmar presença
                        diretamente pelo churrasqueando, e o organizador pode
                        controlar os pagamentos de forma simples.
                    </p>
                    <a class="flex items-center text-red-700 group hover:text-red-500 font-medium text-lg transition-all duration-300 max-md:hidden"
                        href="/contactus">
                        Fale com nossa equipe
                        <x-lucide-chevron-right class="size-5 ml-1.5 group-hover:hidden" />
                        <x-lucide-arrow-right class="size-5 ml-1.5 hidden group-hover:inline-block" />
                    </a>
                </div>
            </div>

            <div class="flex flex-col items-center justify-between gap-16 lg:flex-row">
                <div class="lg:w-1/2 space-y-8">
                    <h2 class="text-4xl font-bold leading-tight text-gray-800">
                        Sugestões e <span class="text-red-700">recomendações</span>
                    </h2>
                    <p class="text-lg text-gray-600 max-w-lg">
                        Baseado no número de participantes e em churrascos anteriores,
                        o churrasqueando oferece sugestões de cortes e tipos de carne,
                        facilitando ainda mais o planejamento.
                    </p>
                    <a class="flex items-center text-red-700 group hover:text-red-500 font-medium text-lg transition-all duration-300 max-md:hidden"
                        href="{{ route('barbecues.create') }}">
                        Criar churrasco
                        <x-lucide-chevron-right class="size-5 ml-1.5 group-hover:hidden" />
                        <x-lucide-arrow-right class="size-5 ml-1.5 hidden group-hover:inline-block" />
                    </a>
                </div>
                <div class="lg:w-1/2 shadow-2xl shadow-gray-300/50 rounded-xl overflow-hidden">
                    <img class="object-cover w-full hover:scale-105 transition-transform duration-700"
                        alt="Sugestões de carne" src={{ asset('png/bacon.png') }}>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full bg-red-50/50 py-24">
        <div class="max-xl:px-8 container max-w-7xl mx-auto text-center space-y-8">
            <h2 class="text-4xl font-bold text-gray-800">Comece seu <span class="text-red-700">churrasco</span> agora</h2>
            <p class="text-lg text-gray-600 mx-auto max-w-2xl">
                Organize churrascos memoráveis sem complicações.
                Planeje, convide e aproveite com a Churrasqueando.
            </p>
            <a class="inline-flex items-center bg-red-700 px-8 py-4 text-white text-lg rounded-3xl group transition-all duration-300 hover:bg-red-600 hover:shadow-lg hover:shadow-red-700/30 mt-4"
                href="{{ route('barbecues.create') }}">
                Começar agora
                <x-lucide-arrow-right class="size-5 ml-2" />
            </a>
        </div>
    </div>
@endsection
