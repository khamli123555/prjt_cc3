<aside class="w-64 bg-slate-900 text-slate-300 min-h-screen fixed left-0 top-0 z-40 hidden lg:block border-r border-slate-800">
    <div class="h-full flex flex-col">
        <!-- Logo Area -->
        <div class="p-6 flex items-center gap-3">
            <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-500/20">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <span class="text-lg font-bold text-white tracking-tight">MedAdmin</span>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-slate-800 hover:text-white border-transparent">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>{{ __('app.nav.dashboard') }}</span>
            </x-nav-link>

            <x-nav-link :href="route('appointments.index')" :active="request()->routeIs('appointments.*')" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-slate-800 hover:text-white border-transparent">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>{{ __('app.nav.appointments') }}</span>
            </x-nav-link>

            <x-nav-link :href="route('patients.index')" :active="request()->routeIs('patients.*')" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-slate-800 hover:text-white border-transparent">
                <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span>{{ __('app.nav.patients') }}</span>
            </x-nav-link>

            <x-nav-link :href="route('doctors.index')" :active="request()->routeIs('doctors.*')" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 hover:bg-slate-800 hover:text-white border-transparent">
                <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>{{ __('app.nav.doctors') }}</span>
            </x-nav-link>
        </nav>

        <!-- User Profile Quick Actions -->
        <div class="p-4 border-t border-slate-800 mt-auto">
            <div class="bg-slate-800/50 rounded-2xl p-4">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-500 flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400 truncate">Administrator</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-xs font-semibold text-slate-400 hover:text-white transition-colors">
                        {{ __('app.nav.logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>
