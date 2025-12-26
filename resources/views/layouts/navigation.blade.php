<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- LEFT: LOGO + MENU -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="text-lg font-bold text-gray-800">
                    🚑 GMCI Dispatch
                </a>

                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                   class="text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600">
                    Dashboard
                </a>

                @if(auth()->user()->role === 'admin')
                    <!-- Admin Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                       class="text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600">
                        Admin
                    </a>

                    <!-- Ambulances -->
                    <a href="{{ route('admin.ambulances.index') }}"
                       class="text-sm font-medium {{ request()->routeIs('admin.ambulances.*') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600">
                        Ambulances
                    </a>

                    <!-- Drivers -->
                    <a href="{{ route('admin.drivers.index') }}"
                       class="text-sm font-medium {{ request()->routeIs('admin.drivers.*') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600">
                        Drivers
                    </a>

                    <!-- Dispatch (future) -->
                    <span class="text-sm text-gray-400 cursor-not-allowed">
                        Dispatch
                    </span>
                @endif
            </div>

            <!-- RIGHT: USER + LOGOUT -->
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="text-sm font-medium text-red-600 hover:text-red-800">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>
