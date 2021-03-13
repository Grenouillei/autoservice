<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<nav x-data="{ open: false }" >
    <!-- Primary Navigation Menu
    <div >
        <div >
            <div > -->
            <!-- Logo
                <div class="flex-shrink-0 flex items-center">
                    <a href="">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>-->

            <!-- Navigation Links
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">

                </x-nav-link>
            </div>
        </div>-->

                <!-- Settings Dropdown -->
                <div class="" style="">
                    <x-dropdown align="right" width="48" >
                        <x-slot name="trigger">

                            <div>{{ Auth::user()->name }}
                                <!-- <img src="img/arrow1.svg" height="11px" width="11px" style="margin-left: 2px;">-->
                            </div>

                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication
                            <form method="POST" action="{{ route('logout') }}" style="background-color: #dc143c; border-radius: 5px;
                                margin-top: 5px; height: 25px; text-align: center " class="reg_form">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')"
                                                       onclick="event.preventDefault();
                                this.closest('form').submit();" style=" color: #1a202c; " class="reg_exit">
                                    {{ __('Вихід') }}
                                </x-responsive-nav-link>-->
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            </div>-->

        <!-- Responsive Navigation Menu
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">

            </x-responsive-nav-link>
        </div>-->

        <!-- Responsive Settings Options
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>-->
    <a class="" style="position: absolute;
    margin-top: -20px;
    margin-left: 54px;">/</a>
        <div class="" style="margin-left: 65px;
    margin-top: -20.5px;
    position: absolute;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

            <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();" class="reg_item">
                        {{ __('Вихід') }}
            </x-responsive-nav-link>
        </form>
    </div>
    <!-- </div>
 </div>-->
</nav>
