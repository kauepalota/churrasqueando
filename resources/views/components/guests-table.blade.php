@props(['guests', 'canSetPaid' => false])

<x-table.table>
    <x-table.table-header>
        <x-table.table-row>
            <x-table.table-head>Nome</x-table.table-head>
            <x-table.table-head>Email</x-table.table-head>
            @if ($canSetPaid)
                <x-table.table-head>Status</x-table.table-head>
            @endif

            <x-table.table-head>Ações</x-table.table-head>
        </x-table.table-row>
    </x-table.table-header>
    <x-table.table-body>
        @forelse ($guests as $guest)
            <x-table.table-row>
                <x-table.table-cell>{{ $guest->name }}</x-table.table-cell>
                <x-table.table-cell>{{ $guest->email }}</x-table.table-cell>

                @if ($canSetPaid)
                    <x-table.table-cell>{{ $guest->has_paid ? 'Pago' : 'Pendente' }}</x-table.table-cell>
                @endif

                <x-table.table-cell>
                    <form method="POST" action="{{ route('guests.destroy', $guest->id) }}">
                        @csrf
                        @method('DELETE')
                        <x-button type="submit" class="w-min text-white">
                            Remover
                        </x-button>
                    </form>
                </x-table.table-cell>

            </x-table.table-row>
        @empty
            <x-table.table-row>
                <x-table.table-cell colspan="{{ $canSetPaid ? 2 : 1 }}">
                    Nenhum convidado confirmado ainda.
                </x-table.table-cell>
            </x-table.table-row>
        @endforelse
    </x-table.table-body>
</x-table.table>
