<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl heading-gradient leading-tight">
            {{ __('messages.nav.dashboard') }}
        </h2>
    </x-slot>

    @php
        $totalApps = \App\Models\Appointment::count();
        $todayApps = \App\Models\Appointment::whereDate('date', today())->count();
        $pendingApps = \App\Models\Appointment::where('status', 'pending')->count();
        $patientsCount = \App\Models\User::where('role', 'patient')->count();
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="glass-card p-6 flex flex-col items-center justify-center text-center">
                    <span class="text-3xl font-black text-indigo-600 mb-1">{{ $totalApps }}</span>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('messages.dashboard_stats.total_appointments') }}</span>
                </div>
                <div class="glass-card p-6 flex flex-col items-center justify-center text-center">
                    <span class="text-3xl font-black text-emerald-600 mb-1">{{ $todayApps }}</span>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('messages.dashboard_stats.today_appointments') }}</span>
                </div>
                <div class="glass-card p-6 flex flex-col items-center justify-center text-center">
                    <span class="text-3xl font-black text-amber-600 mb-1">{{ $pendingApps }}</span>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('messages.dashboard_stats.pending_appointments') }}</span>
                </div>
                <div class="glass-card p-6 flex flex-col items-center justify-center text-center">
                    <span class="text-3xl font-black text-purple-600 mb-1">{{ $patientsCount }}</span>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ __('messages.dashboard_stats.patients_count') }}</span>
                </div>
            </div>

            <!-- Welcome Card -->
            <div class="glass-card overflow-hidden">
                <div class="p-12 text-slate-900 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl flex items-center justify-center text-white text-4xl font-bold mx-auto mb-6 shadow-xl shadow-indigo-200">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 mb-2 tracking-tight">
                        {{ Auth::user()->role === 'admin' ? 'Admin Portal' : (Auth::user()->role === 'doctor' ? 'Doctor Workspace' : 'Patient Lounge') }}
                    </h3>
                    <p class="text-xl font-bold heading-gradient">Welcome back, {{ Auth::user()->name }}!</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
