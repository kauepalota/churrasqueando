@extends('layouts.app', ['header' => true, 'footer' => true])

@section('title', 'Dashboard')

@section('content')
    <div class="max-xl:px-6 max-w-7xl container mx-auto py-12">
        <h1 class="text-2xl font-bold mb-6">Meus Churrascos</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($barbecues as $barbecue)
                <div class="p-6 bg-white rounded shadow">
                    <p>Data: {{ $barbecue->date }}</p>
                    <p>Local: {{ $barbecue->address }}</p>
                    <p>Participantes: {{ $barbecue->participants }}</p>
                    <a href="{{ route('barbecues.edit', $barbecue->id) }}" class="text-blue-500 hover:underline">Visualizar</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
