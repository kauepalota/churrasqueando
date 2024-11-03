@extends('layouts.app', ['header' => true, 'footer' => true])

@section('title', 'Churrasqueando')

@php
    $radioOptions = config('barbecue-formats')
@endphp

@section('main-attributes')
    class="bg-gray-50/75"
@endsection

@section('content')
    <div class="pt-12 max-xl:px-6 container max-w-7xl mx-auto flex flex-col lg:flex-row items-center justify-between gap-12">
        <div class="lg:w-1/2">
            <img class="rounded-lg object-cover w-full" alt="Barbecue" src={{ asset('svg/barbecue2.svg') }}>
        </div>
        <div class="mb-12 lg:w-1/2 bg-white shadow-md rounded-lg p-8">
            <div class="text-center mb-6">
                <h1 class="text-xl font-bold">Crie o seu churrasco!</h1>
                <p class="text-gray-500 mt-2">Vamos fornecer ferramentas que facilitam a organização e o controle de convidados, alimentos e bebidas.</p>
            </div>

            <form method="POST" action="{{ route('barbecues.store') }}">
                @csrf
                <x-input label="Participantes esperados" name="participants" type="number" placeholder="10" />
                <x-input label="Endereço" name="address" type="text" placeholder="Rua Rio de Janeiro, 200" />

                <x-date-picker id="date" name="date" />

                <label class="block text-gray-700 text-sm mb-2" for="format">
                    Formato do churrasco
                </label>

                <x-radio-group required :options="$radioOptions" name="radio-group" />

                <div class="flex items-center justify-between">
                    <x-button type="submit">Criar</x-button>
                </div>
            </form>
        </div>
    </div>
@endsection
