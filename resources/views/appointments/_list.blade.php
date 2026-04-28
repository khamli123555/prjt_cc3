@forelse ($appointments as $appointment)
    <tr class="group hover:bg-slate-50/50 transition-all duration-300">
        <td class="py-5 px-4">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600 font-bold text-sm shadow-sm">
                    {{ substr($appointment->patient->name, 0, 1) }}
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-slate-900 leading-tight">{{ $appointment->patient->name }}</span>
                    <span class="text-xs text-slate-500">{{ $appointment->patient->email }}</span>
                </div>
            </div>
        </td>
        <td class="py-5 px-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-slate-100 rounded-xl flex items-center justify-center text-slate-500 font-bold text-xs">
                    {{ substr($appointment->doctor->name, 0, 1) }}
                </div>
                <span class="text-sm font-medium text-slate-700">{{ $appointment->doctor->name }}</span>
            </div>
        </td>
        <td class="py-5 px-4">
            <div class="flex flex-col">
                <span class="text-sm font-bold text-slate-900">{{ $appointment->service->name }}</span>
                <div class="flex items-center gap-1.5 mt-1">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span class="text-xs text-slate-500 font-medium">{{ $appointment->service->duration }} {{ __('app.units.minutes') }}</span>
                </div>
            </div>
        </td>
        <td class="py-5 px-4">
            <div class="flex flex-col">
                <div class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    <span class="text-sm font-bold text-slate-900">{{ $appointment->date->format('d M, Y') }}</span>
                </div>
                <span class="text-xs text-slate-500 mt-1 font-medium">{{ $appointment->date->format('h:i A') }}</span>
            </div>
        </td>
        <td class="py-5 px-4">
            <span @class([
                'inline-flex items-center px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-sm border',
                'bg-amber-50 text-amber-600 border-amber-100' => $appointment->status === 'pending',
                'bg-emerald-50 text-emerald-600 border-emerald-100' => $appointment->status === 'confirmed',
                'bg-rose-50 text-rose-600 border-rose-100' => $appointment->status === 'cancelled',
            ])>
                <span class="w-1.5 h-1.5 rounded-full me-2 @if($appointment->status === 'pending') bg-amber-400 animate-pulse @elseif($appointment->status === 'confirmed') bg-emerald-400 @else bg-rose-400 @endif"></span>
                {{ __('app.status.' . $appointment->status) }}
            </span>
        </td>
        <td class="py-5 px-4 text-right">
            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
                <a href="{{ route('appointments.edit', $appointment) }}" class="p-2.5 text-indigo-600 hover:bg-indigo-50 rounded-2xl transition-all" title="{{ __('app.buttons.edit') }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>
                @if ($appointment->status !== 'cancelled')
                    <button type="button" class="p-2.5 text-rose-600 hover:bg-rose-50 rounded-2xl transition-all"
                        @click="openCancelModal('{{ route('appointments.destroy', $appointment) }}')"
                        title="{{ __('app.buttons.cancel') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                @endif
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="py-20 text-center">
            <div class="flex flex-col items-center justify-center">
                <div class="w-20 h-20 bg-slate-50 rounded-[2.5rem] flex items-center justify-center mb-6 border border-slate-100">
                    <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <p class="text-lg font-bold text-slate-900 mb-1">{{ __('app.appointment.empty') }}</p>
                <p class="text-sm text-slate-500">{{ __('Get started by creating your first appointment.') }}</p>
            </div>
        </td>
    </tr>
@endforelse
