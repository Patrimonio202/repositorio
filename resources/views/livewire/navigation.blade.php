<nav id="menu" x-data="{ open: false }"
    class="bg-{{ $colorbanner }} border-b border-gray-100  sticky top-0 start-0 z-50 ">
    <!-- Primary Navigation Menu  sticky top-0 start-0 z-50 -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex justify-between h-16 ">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('posts.index') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>


                <!-- Links de navegacion computador - carrusel -->
                {{-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('posts.carrusel') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Carrusel') }}
                    </x-nav-link>
                </div> --}}

                <!-- Links de navegacion computador - Imagenes -->
                {{-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{  route('posts.category', 'imagenes') }}" :active="request()->routeIs('index')">
                        <img src="{{ Storage::url('Imagenes/Imagenes.jpg') }}" class="w-50 h-10 rounded-lg" alt="...">
                    </x-nav-link>
                </div> --}}

                <!-- Cargar datos desde base de datos -->
                {{-- @foreach ($categories as $category)                 
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">                           
                            <x-nav-link href="{{ route('posts.category', $category) }}" :active="request()->routeIs('posts.category', $category)">
                                {{ $category->name }}
                            </x-nav-link>
                        </div>                   
                @endforeach  --}}

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('posts.category', 'imagenes') }}" :active="request()->Is('category/imagenes')">
                        {{ __('Imágenes') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px md:ml-1 lg:ml-10  sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('posts.category', 'audios') }}" :active="request()->Is('category/audios')">
                        {{ __('Audios') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px  md:ml-1 lg:ml-10 sm:ml-10  sm:flex">
                    <x-nav-link href="{{ route('posts.category', 'publicaciones') }}" :active="request()->Is('category/publicaciones')">
                        {{ __('Publicaciones') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px md:ml-1  lg:ml-10 sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('posts.category', 'videos') }}" :active="request()->Is('category/videos')">
                        {{ __('Videos') }}
                    </x-nav-link>
                </div>

                <!-- acerca de -->
                <div class="hidden  space-x-8 sm:-my-px  md:ml-1 lg:ml-10 sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('inicio.acercade') }}" :active="request()->routeIs('inicio.acercade')">
                        {{ __('Acerca de') }}
                    </x-nav-link>
                </div>

            </div>

            <!-- Este es el menu administrar cuenta -->
            @auth
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <!-- Teams Dropdown -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="ml-3 relative">
                            <x-dropdown align="right" width="60">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->currentTeam->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="w-60">
                                        <!-- Team Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Team') }} <!-- Manage Team -->
                                        </div>

                                        <!-- Team Settings -->
                                        <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            {{ __('Team Settings') }}
                                        </x-dropdown-link>

                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-dropdown-link href="{{ route('teams.create') }}">
                                                {{ __('Create New Team') }}
                                            </x-dropdown-link>
                                        @endcan

                                        <!-- Team Switcher -->
                                        @if (Auth::user()->allTeams()->count() > 1)
                                            <div class="border-t border-gray-200"></div>

                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Switch Teams') }}
                                            </div>

                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-switchable-team :team="$team" />
                                            @endforeach
                                        @endif
                                    </div>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endif

                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Administrar cuenta') }} <!-- Manage Account-->
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Perfil') }} <!-- Profile-->
                                </x-dropdown-link>
                                @can('admin.home')
                                    <x-dropdown-link href="{{ route('admin.home') }}">
                                        {{ __('Administración') }} <!-- Profile-->
                                    </x-dropdown-link>
                                @endcan


                                <x-dropdown-link href="{{ route('posts.destacado') }}">
                                    {{ __('Mis preferidos') }} <!-- Profile-->
                                </x-dropdown-link>



                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication cerrar session computador -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Cerrar sesión') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <a href="{{ route('posts.buscar') }}"
                        class="inline-flex items-center px-1 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                        <!-- Boton lupa despues de logueo-->
                        <i class="fa-solid fa-magnifying-glass fa-lg" style="color: #ca9e67;"></i>

                    </a>
                </div>
            @else
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="flex ml-3 relative">

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-1 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        <!-- Menu opciones usuarios-->
                                        <i class="fa-solid fa-circle-user fa-xl" style="color: #ca9e67;"></i>
                                    </button>

                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Opciones de ingreso') }} <!-- Manage Account-->
                                </div>

                                <x-dropdown-link href="{{ route('login') }}">
                                    {{ __('Ingresar') }} <!-- Profile-->
                                </x-dropdown-link>

                                @if (Route::has('register'))
                                    <x-dropdown-link href="{{ route('register') }}">
                                        {{ __('Registrarse') }} <!-- Profile-->
                                    </x-dropdown-link>
                                @endif
                            </x-slot>
                        </x-dropdown>

                        <a href="{{ route('posts.buscar') }}"
                            class="inline-flex items-center px-1 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            <!-- Boton lupa-->
                            <i class="fa-solid fa-magnifying-glass fa-lg" style="color: #ca9e67;"></i>

                        </a>
                    </div>
                </div>


            @endauth
            <!-- hasta aqui -->

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
              {{ __('Inicio') }}
          </x-responsive-nav-link> --}}

            @foreach ($categories as $category)
                <x-responsive-nav-link href="{{ route('posts.category', $category) }}" :active="request()->routeIs('dashboard')">
                    {{ $category->name }}
                </x-responsive-nav-link>
            @endforeach

            <x-responsive-nav-link href="{{ route('inicio.acercade') }}" :active="request()->routeIs('inicio.acercade')">
                {{ __('Acerca de') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('posts.buscar') }}" :active="request()->routeIs('posts.buscar')">
                {{ __('Buscar') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options para el celular -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">

                <div class="flex items-center px-4">

                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 mr-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif


                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link href="{{ route('posts.destacado') }}" :active="request()->routeIs('posts.destacado')">
                        {{ __('Mis preferidos') }}
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication cerrar session -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Cerrar sesión') }}
                        </x-responsive-nav-link>
                    </form>
                    <!-- hasta aqui  cerrar session -->

                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>

                        <!-- Team Settings -->
                        <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                            :active="request()->routeIs('teams.show')">
                            {{ __('Team Settings') }}
                        </x-responsive-nav-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                {{ __('Create New Team') }}
                            </x-responsive-nav-link>
                        @endcan

                        <!-- Team Switcher -->
                        @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" component="responsive-nav-link" />
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200">

                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        {{ __('Ingresar') }}
                    </x-responsive-nav-link>

                </div>

                @if (Route::has('register'))
                    <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                        {{ __('Registrarse') }}
                    </x-responsive-nav-link>
                @endif
            </div>


        @endauth
    </div>

    @push('js')
        <script>
        //    window.onscroll = function() {
        //         myFunction()
        //     };

        //     function myFunction() {
        //         //const fas = document.getElementById("menu");
        //         if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        //             document.getElementById("menu").className = "bg-blue-400 border-b border-gray-100  sticky top-0 start-0 z-50";
        //         } else {
        //             //posicion normal
        //            document.getElementById("menu").className = "bg-white border-b border-gray-100  sticky top-0 start-0 z-50";
        //         }
        //     }
           
        </script>
    @endpush
</nav>
