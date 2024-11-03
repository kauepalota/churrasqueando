@extends('layouts.app', ['header' => true, 'footer' => true])

@section('title', 'Confirmação')

@section('content')
    <div class="max-w-7xl container mx-auto py-12">
        <h1 class="text-2xl font-bold mb-6">Confirmação de Presença</h1>

        @if (session('success'))
            <div class="text-green-500 mb-4">
                {{ session('success') }}
            </div>
        @else
            <div class="text-red-500 mb-4">
                Algo deu errado ao registrar sua presença.
            </div>
        @endif
    </div>
@endsection
