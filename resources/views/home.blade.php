@extends('layouts.app', ['header' => true, 'footer' => true])

@section('title', 'Churrasqueando')

@section('content')
    <div class="mt-12 max-xl:px-6 container max-w-7xl mx-auto flex flex-col lg:flex-row items-center justify-between gap-12">
        <div class="lg:w-1/2 space-y-6">
            <h2 class="text-4xl font-bold leading-tight">Organize Seu Churrasco Perfeito com Facilidade</h2>
            <p class="text-lg">
                Churrasqueando simplifica o planejamento do seu churrasco.
                Gerencie convidados, custos e cardápios em um só lugar.
            </p>

            <a class="whitespace-nowrap max-w-min flex items-center bg-red-700 px-4 py-2.5 text-white rounded-3xl group transition-colors hover:bg-red-600"
               href="{{route('barbecues.create')}}">
                Criar churrasco
                <x-lucide-chevron-right class="size-4 ml-0.5 group-hover:hidden"/>
                <x-lucide-arrow-right class="size-4 ml-0.5 hidden group-hover:inline-block"/>
            </a>
        </div>
        <div class="lg:w-1/2">
            <img class="rounded-lg object-cover w-full" alt="Barbecue" src={{ asset('svg/barbecue.svg') }}>
        </div>
    </div>
    <div class="flex w-screen min-h-full mt-12 py-12">
        <div class="max-xl:px-6 container space-y-6 max-w-7xl mx-auto">
            <div class="flex flex-col items-center justify-between gap-12 lg:flex-row">
                <div class="lg:w-1/2 order-2 lg:order-1">
                    <img class="rounded-lg object-cover w-full" alt="Barbecue" src={{ asset('svg/payment.svg') }}>
                </div>
                <div class="lg:w-1/2 space-y-6 order-1 lg:order-2">
                    <h2 class="text-3xl font-bold leading-tight">
                        Confirmação de presença e pagamentos
                    </h2>
                    <p class="text-md">
                        Os participantes podem confirmar presença
                        diretamente pelo churrasqueando, e o organizador pode
                        controlar os pagamentos de forma simples.
                    </p>
                    <a class="flex items-center text-red-700 group hover:text-red-500 max-md:hidden" href="/contactus">
                        Fale com nossa equipe
                        <x-lucide-chevron-right class="size-4 ml-0.5 group-hover:hidden"/>
                        <x-lucide-arrow-right class="size-4 ml-0.5 hidden group-hover:inline-block"/>
                    </a>
                </div>
            </div>
            <div class="flex flex-col items-center justify-between gap-12 lg:flex-row">
                <div class="lg:w-1/2 space-y-6">
                    <h2 class="text-3xl font-bold leading-tight">
                        Sugestões e recomendações
                    </h2>
                    <p class="text-md">
                        Baseado no número de participantes e em churrascos anteriores,
                        o churrasqueando oferece sugestões de cortes e tipos de carne,
                        facilitando ainda mais o planejamento.
                    </p>
                    <a class="flex items-center text-red-700 group hover:text-red-500 max-md:hidden" href="{{route('barbecues.create')}}">
                        Criar churrasco
                        <x-lucide-chevron-right class="size-4 ml-0.5 group-hover:hidden"/>
                        <x-lucide-arrow-right class="size-4 ml-0.5 hidden group-hover:inline-block"/>
                    </a>
                </div>
                <div class="lg:w-1/2">
                    <img class="rounded-lg object-cover w-full" alt="Barbecue" src={{ asset('png/bacon.png') }}>
                </div>
            </div>
        </div>
    </div>
@endsection
