<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Churrasqueando')</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        :root {
            --background: 0 0% 100%;
            --foreground: 240 10% 3.9%;
            --card: 0 0% 100%;
            --card-foreground: 240 10% 3.9%;
            --popover: 0 0% 100%;
            --popover-foreground: 240 10% 3.9%;
            --primary: 240 5.9% 10%;
            --primary-foreground: 0 0% 98%;
            --secondary: 240 4.8% 95.9%;
            --secondary-foreground: 240 5.9% 10%;
            --muted: 240 4.8% 95.9%;
            --muted-foreground: 240 3.8% 46.1%;
            --accent: 240 4.8% 95.9%;
            --accent-foreground: 240 5.9% 10%;
            --destructive: 0 84.2% 60.2%;
            --destructive-foreground: 0 0% 98%;
            --border: 240 5.9% 90%;
            --input: 240 5.9% 90%;
            --ring: 240 5.9% 10%;
            --radius: 0.5rem;
            --chart-1: 12 76% 61%;
            --chart-2: 173 58% 39%;
            --chart-3: 197 37% 24%;
            --chart-4: 43 74% 66%;
            --chart-5: 27 87% 67%;
        }
    </style>

    @vite('resources/css/app.css')
</head>

<body class="flex flex-col font-[Inter] min-h-screen bg-white">
    @if ($header ?? false)
        <header class="p-6 sticky top-0 z-50 bg-white/90 backdrop-blur-sm shadow-sm">
            <div class="container max-w-7xl mx-auto flex justify-between items-center">
                <a href="/"
                    class="transition-colors text-red-700 text-2xl flex items-center font-bold hover:text-red-500">
                    <x-lucide-flame class="size-6 mr-2" />
                    Churrasqueando
                </a>

                <nav class="flex text-sm flex-row space-x-6 items-center">
                    <a class="flex items-center text-gray-700 group hover:text-red-600 transition-colors max-md:hidden font-medium"
                        href="/contactus">
                        Fale com nossa equipe
                        <x-lucide-chevron-right class="size-4 ml-0.5 group-hover:hidden" />
                        <x-lucide-arrow-right class="size-4 ml-0.5 hidden group-hover:inline-block" />
                    </a>
                    <a class="flex items-center bg-red-700 px-5 py-2.5 text-white rounded-3xl group transition-all duration-300 hover:bg-red-600 hover:shadow-lg hover:shadow-red-700/30"
                        href="{{ route('login') }}">
                        @guest
                            Entrar
                        @endguest

                        @auth
                            Minha conta
                        @endauth
                        <x-lucide-chevron-right class="size-4 ml-1.5 group-hover:hidden" />
                        <x-lucide-arrow-right class="size-4 ml-1.5 hidden group-hover:inline-block" />
                    </a>
                </nav>
            </div>
        </header>

        @if ($errors->any())
            <div
                class="bg-red-100 border border-red-500 text-red-700 p-4 rounded-lg mb-6 max-w-lg mx-auto mt-4 shadow-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endisset

    <main class="flex flex-1 flex-col w-screen items-center" @yield('main-attributes')>
        @yield('content')
    </main>

    @if ($footer ?? false)
        <footer class="bg-gray-900 text-white">
            <div class="container max-w-7xl mx-auto py-12 px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="space-y-4">
                        <a href="/" class="flex items-center text-2xl font-bold">
                            <x-lucide-flame class="size-6 mr-2 text-red-500" />
                            Churrasqueando
                        </a>
                        <p class="text-gray-400">
                            Seu assistente completo para organizar churrascos perfeitos de maneira fácil e
                            divertida.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Links Úteis</h3>
                        <ul class="space-y-2">
                            <li><a href="/" class="text-gray-400 hover:text-white transition-colors">Home</a>
                            </li>
                            <li><a href="{{ route('barbecues.create') }}"
                                    class="text-gray-400 hover:text-white transition-colors">Criar Churrasco</a>
                            </li>
                            <li><a href="/contactus" class="text-gray-400 hover:text-white transition-colors">Fale
                                    Conosco</a></li>
                        </ul>
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Contato</h3>
                        <p class="text-gray-400">
                            contato@churrasqueando.com.br<br>
                            São Paulo, SP - Brasil
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                    </path>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5">
                                    </rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                    <p class="text-gray-500">
                        &copy; 2024 Churrasqueando. Todos os direitos reservados.
                    </p>
                </div>
            </div>
        </footer>
    @endisset
</body>

</html>
