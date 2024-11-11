@props(['barbecue'])

<div x-data="{ modelOpen: false }">
    <button @click="modelOpen =!modelOpen"
        class="bg-red-700 hover:bg-red-500 w-full text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        <span>Enviar solicitações de pagamento</span>
    </button>

    <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

            <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">

                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium text-gray-800 ">Enviar solicitações de pagamento</h1>

                    <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <x-lucide-x class="w-6 h-6 text-gray-600 focus:outline-none hover:text-gray-700" />
                    </button>
                </div>

                <p class="mt-2 text-sm text-gray-500 ">
                    Lembre-se que ao enviar a solicitação de pagamento, seus convidados não poderão mais confirmar presença.
                </p>

                <form class="mt-2" method="POST" action="{{ route('barbecues.createPaymentLink', $barbecue->id) }}">
                    @csrf
                    @method('POST')
                    <x-input label="Valor total (R$)" name="total_cost" type="number" placeholder="200" />

                    <div class="flex justify-end mt-6">
                        <x-button type="submit">Enviar</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
