@extends('layouts.app', ['header' => true, 'footer' => true])

@php
    $radioOptions = config('barbecue-formats');
@endphp

@section('title', 'Visualizar Churrasco')

@section('main-attributes')
    class="bg-gray-50 flex items-center justify-center min-h-screen"
@endsection

@section('content')
    @if (session('success'))
        <div class="text-green-500 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="text-red-500 mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="max-xl:px-6 max-w-4xl w-full bg-white shadow-md rounded-lg mt-12 p-8">
        <h3 class="text-2xl font-semibold">Visualizar churrasco</h3>

        @if (!$barbecue->payment_link_sent)
            <form class="mt-2" method="POST" action="{{ route('barbecues.update', $barbecue->id) }}">
                @csrf
                @method('PUT')

                <x-input label="Endereço" name="address" type="text" value="{{ $barbecue->address }}" />
                <x-date-picker id="date" name="date" value="{{ $barbecue->date }}" :readonly="true" />

                <label class="block text-gray-700 text-sm mb-2" for="format">
                    Formato do churrasco
                </label>
                <x-radio-group required :options="$radioOptions" name="format" :selected="$barbecue->format" :readonly="false" />

                <div class="flex items-center justify-between mt-6">
                    <x-button type="submit">Atualizar</x-button>
                </div>
            </form>
        @else
            <div class="mt-2">
                <p><strong>Endereço:</strong> {{ $barbecue->address }}</p>
                <p><strong>Data:</strong> {{ $barbecue->date }}</p>

                @php
                    $formatTitle = 'Formato desconhecido'; // Default value

                    foreach ($radioOptions as $format) {
                        if ($format['value'] == $barbecue->format) {
                            $formatTitle = $format['title'];
                            break;
                        }
                    }
                @endphp

                <p><strong>Formato:</strong> {{ $formatTitle }}</p>
            </div>
        @endif

        <div class="mt-6">
            @if (!$barbecue->payment_link_sent)
                <div class="mb-4">
                    <label for="share-link" class="text-gray-700 text-sm mb-2">Link de Compartilhamento</label>
                    <div class="relative">
                        <input id="share-link" type="text" value="{{ route('guests.show', $barbecue->id) }}" readonly
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <button type="button" onclick="copyToClipboard()" class="right-2 top-2 absolute ml-4">
                            <x-lucide-clipboard-copy class="size-5" />
                        </button>
                    </div>
                </div>
            @endif

            <h2 class="text-xl font-bold mb-4">Convidados Confirmados</h2>

            @if ($barbecue->format === 'split_equally')
                @if ($barbecue->guests->count() > 0)
                    <div class="my-2">
                        <x-send-payment :barbecue="$barbecue" />
                    </div>
                @endif
            @endif

            <x-guests-table :guests="$barbecue->guests" :canRemove="true" :canSetPaid="$barbecue->format === 'split_equally'" />
        </div>
    </div>

    <script>
        function copyToClipboard() {
            const copyText = document.getElementById("share-link");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // Para dispositivos móveis
            navigator.clipboard.writeText(copyText.value);
        }
    </script>
@endsection
