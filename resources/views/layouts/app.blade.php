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

<body class="flex flex-col font-[Poppins] min-h-screen">
    @if ($header ?? false)
        <header class="p-6">
            <div class="container max-w-7xl mx-auto flex justify-between items-center">
                <a href="/"
                    class="transition-colors text-red-700 text-2xl flex items-center font-bold hover:text-red-500">
                    <x-lucide-flame class="size-6 mr-2" />
                    Churrasqueando
                </a>

                <nav class="flex text-sm flex-row space-x-4 items-center">
                    <a class="flex items-center text-red-700 group hover:text-red-500 max-md:hidden" href="/contactus">
                        Fale com nossa equipe
                        <x-lucide-chevron-right class="size-4 ml-0.5 group-hover:hidden" />
                        <x-lucide-arrow-right class="size-4 ml-0.5 hidden group-hover:inline-block" />
                    </a>
                    <a class="flex items-center bg-red-700 px-4 py-2.5 text-white rounded-3xl group transition-colors hover:bg-red-600"
                        href="{{ route('login') }}">
                        @guest
                            Entrar
                        @endguest

                        @auth
                            Minha conta
                        @endauth
                        <x-lucide-chevron-right class="size-4 ml-0.5 group-hover:hidden" />
                        <x-lucide-arrow-right class="size-4 ml-0.5 hidden group-hover:inline-block" />
                    </a>
                </nav>
            </div>
        </header>

        @if ($errors->any())
            <div class="bg-red-200 border border-red-600 text-red-600 p-4 rounded-lg mb-6">
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
        <footer class="bg-red-500">
            <div class="container w-full min-h-full mx-auto py-12 text-center">
                <p class="text-lg text-white">
                    &copy; 2024 Churrasqueando. Todos os direitos reservados.
                </p>
            </div>
        </footer>
    @endisset
</body>

</html>
