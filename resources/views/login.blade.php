@extends('layouts.app', ['header' => true, 'footer' => true])

@section('title', 'Faça login no Churrasqueando')

@section('main-attributes')
    class="bg-gray-50 flex items-center justify-center h-screen"
@endsection

@section('content')
    <div class="max-xl:px-6 max-w-lg w-full bg-white shadow-md rounded-lg p-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold">Cadastre-se hoje e organize o churrasco perfeito</h1>
            <p class="text-gray-500 mt-2">Pronto para planejar o próximo churrasco com eficiência? Cadastre-se e tenha acesso a ferramentas que facilitam a organização e o controle de convidados, alimentos e bebidas.</p>
        </div>

        <form action="{{ route("login-or-register") }}" method="POST">
            @csrf
            <x-input label="E-mail" name="email" type="email" placeholder="seumelhoremail@gmail.com" />
            <x-password-input label="Senha" name="password" placeholder="*********" />

            <div class="flex items-center justify-between">
                <x-button type="submit">Avançar</x-button>
            </div>
        </form>
    </div>
@endsection
