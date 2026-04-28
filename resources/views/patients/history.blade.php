<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('app.patient.history_title') ?? 'Appointment History' }}: {{ $user->name }}
            </h2>
            <a href="{{ route('patients.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-xl font-semibold hover:bg-slate-300 transition-colors">
                {{ __('app.buttons.back') }}
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-6">
            <div class="w-20 h-20 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600 text-3xl font-bold">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-900">{{ $user->name }}</h3>
                <p class="text-slate-500">{{ $user->email }}</p>
                <div class="mt-2 flex gap-4 text-sm text-slate-600">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        {{ $appointments->total() }} {{ __('app.nav.appointments') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm border border-slate-100 rounded-2xl">
            <div class="p-6 text-slate-900">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-separate border-spacing-y-2">
                        <thead>
                            <tr class="text-slate-500">
                                <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.appointment.doctor') }}</th>
                                <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.appointment.service') }}</th>
                                <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.appointment.date_time') }}</th>
                                <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.appointment.status') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse ($appointments as $appointment)
                                <tr class="group hover:bg-slate-50 transition-colors">
                                    <td class="py-4 px-2 text-sm text-slate-700">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center text-slate-500 font-bold text-xs">
                                                {{ substr($appointment->doctor->name, 0, 1) }}
                                            </div>
                                            {{ $appointment->doctor->name }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-2 text-sm text-slate-700">
                                        <span class="font-medium">{{ $appointment->service->name }}</span>
                                    </td>
                                    <td class="py-4 px-2 text-sm text-slate-700">
                                        <div class="flex flex-col">
                                            <span>{{ $appointment->date->format('M d, Y') }}</span>
                                            <span class="text-xs text-slate-500">{{ $appointment->date->format('h:i A') }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-2">
                                        <span @class([
                                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold shadow-sm',
                                            'bg-amber-50 text-amber-700 border border-amber-100' => $appointment->status === 'pending',
                                            'bg-emerald-50 text-emerald-700 border border-emerald-100' => $appointment->status === 'confirmed',
                                            'bg-rose-50 text-rose-700 border border-rose-100' => $appointment->status === 'cancelled',
                                        ])>
                                            <span class="w-1.5 h-1.5 rounded-full me-1.5 @if($appointment->status === 'pending') bg-amber-400 @elseif($appointment->status === 'confirmed') bg-emerald-400 @else bg-rose-400 @endif"></span>
                                            {{ __('app.status.' . $appointment->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center text-slate-500">
                                        {{ __('app.appointment.empty') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $appointments->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
