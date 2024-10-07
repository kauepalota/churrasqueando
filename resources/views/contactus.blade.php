@extends('layouts.app', ['header' => true, 'footer' => true])

@section('title', 'Fale conosco')

@section('main-attributes')
    class="bg-gray-50 flex items-center justify-center h-screen"
@endsection

@section('content')
    <div class="max-w-lg w-full bg-white shadow-md rounded-lg p-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold">Ajude-nos a encaminhar sua solicitação</h1>
            <p class="text-gray-500 mt-4">Preencha o formulário abaixo para entrar em contato conosco.</p>
        </div>

        <form>
            @csrf
            <x-input label="E-mail" name="email" type="email" placeholder="contato@empresa.com" />
            <x-input label="Nome" name="name" type="name" placeholder="João da Silva" />

            <x-textarea label="Mensagem" name="message" placeholder="Digite sua mensagem aqui" />

            <div class="flex items-center justify-between">
                <x-button type="submit">Enviar</x-button>
            </div>
        </form>
    </div>
@endsection
