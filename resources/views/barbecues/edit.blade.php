@extends('layouts.app', ['header' => true, 'footer' => true])

@php
    $radioOptions = config('barbecue-formats')
@endphp


@section('title', 'Visualizar Churrasco')

@section('content')
    <div class="max-xl:px-6 max-w-7xl container mx-auto py-12">
        <h1 class="text-2xl font-bold mb-6">Visualizar Churrasco</h1>

        <form method="POST" action="{{ route('barbecues.update', $barbecue->id) }}">
            @csrf
            @method('PUT')

            <x-input label="Participantes esperados" name="participants" type="number" value="{{ $barbecue->participants }}" />
            <x-input label="Endereço" name="address" type="text" value="{{ $barbecue->address }}" />
            <x-date-picker id="date" name="date" value="{{ $barbecue->date }}" />

            <label class="block text-gray-700 text-sm mb-2" for="format">
                Formato do churrasco
            </label>

            <x-radio-group required :options="$radioOptions" name="radio-group" :selected="$barbecue->format" />

            <div class="mb-4">
                <label for="share-link" class="text-gray-700 text-sm mb-2">Link de Compartilhamento</label>
                <div class="relative">
                    <input id="share-link" type="text" value="{{ route('guests.show', $barbecue->id) }}" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <button type="button" onclick="copyToClipboard()" class="right-2 top-2 absolute ml-4">
                        <x-lucide-clipboard-copy class="size-5" />
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <x-button type="submit">Atualizar</x-button>
            </div>
        </form>

        <div class="mt-12">
            <h2 class="text-xl font-bold mb-4">Convidados Confirmados</h2>
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nome</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                </tr>
                </thead>
                <tbody class="text-gray-700">
                @forelse ($barbecue->guests as $guest)
                    <tr>
                        <td class="text-left py-3 px-4">{{ $guest->name }}</td>
                        <td class="text-left py-3 px-4">{{ $guest->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-left py-3 px-4" colspan="2">Nenhum convidado confirmado ainda.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("share-link");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // Para dispositivos móveis
            navigator.clipboard.writeText(copyText.value);
        }
    </script>
@endsection
