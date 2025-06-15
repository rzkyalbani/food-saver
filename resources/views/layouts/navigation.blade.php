<nav x-data="{ open: false }" class="bg-primary border-b border-primary-dark">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="font-bold text-white text-lg">
                        Food Saver
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                        class="text-white hover:text-white hover:border-white">
                        {{ __('Beranda') }}
                    </x-nav-link>

                    <x-nav-link :href="route('offers.index')" :active="request()->routeIs('offers.index') || request()->routeIs('offers.show')"
                        class="text-white hover:text-white hover:border-white">
                        {{ __('Katalog Penawaran') }}
                    </x-nav-link>

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-white hover:text-white hover:border-white">
                        {{ __('Pesanan Saya') }}
                    </x-nav-link>

                    @auth
                        @if (Auth::user()->role === 'user')
                            <x-nav-link :href="route('onboarding.index')" :active="request()->routeIs('onboarding.index')"
                                class="text-white hover:text-white hover:border-white">
                                {{ __('Jadi Mitra Food Saver') }}
                            </x-nav-link>
                        @endif

                        @if (Auth::user()->role === 'store_owner' || Auth::user()->role === 'admin')
                            <x-nav-link :href="route('partner.dashboard')" :active="request()->routeIs('partner.dashboard')"
                                class="text-white hover:text-white hover:border-white">
                                {{ __('Dashboard Mitra') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-white mr-3">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-1 px-3 py-2 bg-white text-primary hover:bg-gray-100 rounded-md">Register</a>
                    @endif
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-primary-dark focus:outline-none focus:bg-primary-dark focus:text-white transition duration-150 ease-in-out">
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
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')"
                class="text-white hover:text-gray-200 hover:bg-primary-dark">
                {{ __('Beranda') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('offers.index')" :active="request()->routeIs('offers.index')"
                class="text-white hover:text-gray-200 hover:bg-primary-dark">
                {{ __('Katalog Penawaran') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="text-white hover:text-gray-200 hover:bg-primary-dark">
                {{ __('Pesanan Saya') }}
            </x-responsive-nav-link>

            @auth
                @if (Auth::user()->role === 'user')
                    <x-responsive-nav-link :href="route('onboarding.index')" :active="request()->routeIs('onboarding.index')"
                        class="text-white hover:text-gray-200 hover:bg-primary-dark">
                        {{ __('Jadi Mitra Food Saver') }}
                    </x-responsive-nav-link>
                @endif

                @if (Auth::user()->role === 'store_owner' || Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('partner.dashboard')" :active="request()->routeIs('partner.dashboard')"
                        class="text-white hover:text-gray-200 hover:bg-primary-dark">
                        {{ __('Dashboard Mitra') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-primary-dark">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-200">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:text-gray-200 hover:bg-primary-dark">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();"
                            class="text-white hover:text-gray-200 hover:bg-primary-dark">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-primary-dark">
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')" class="text-white hover:text-gray-200 hover:bg-primary-dark">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="text-white hover:text-gray-200 hover:bg-primary-dark">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>
