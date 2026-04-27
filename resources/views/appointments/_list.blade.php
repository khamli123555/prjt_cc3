@forelse ($appointments as $appointment)
    <tr class="group hover:bg-slate-50 transition-colors">
        <td class="py-4 text-sm text-slate-700 font-medium">{{ $appointment->patient->name }}</td>
        <td class="py-4 text-sm text-slate-700">{{ $appointment->doctor->name }}</td>
        <td class="py-4 text-sm text-slate-700">
            <div class="flex flex-col">
                <span class="font-medium">{{ $appointment->service->name }}</span>
                <span class="text-xs text-slate-500">{{ $appointment->service->duration }} {{ __('app.units.minutes') }}</span>
            </div>
        </td>
        <td class="py-4 text-sm text-slate-700">
            <div class="flex flex-col">
                <span>{{ $appointment->date->format('M d, Y') }}</span>
                <span class="text-xs text-slate-500">{{ $appointment->date->format('h:i A') }}</span>
            </div>
        </td>
        <td class="py-4">
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
        <td class="py-4 text-right">
            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <a href="{{ route('appointments.edit', $appointment) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="{{ __('app.buttons.edit') }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>
                @if ($appointment->status !== 'cancelled')
                    <button type="button" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
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
        <td colspan="6" class="py-12 text-center">
            <div class="flex flex-col items-center justify-center text-slate-500">
                <svg class="w-12 h-12 mb-4 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-sm font-medium">{{ __('app.appointment.empty') }}</p>
            </div>
        </td>
    </tr>
@endforelse
