<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Appointments') }}
            </h2>
            <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-indigo-200">
                New Appointment
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if (session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm border border-slate-100 rounded-2xl">
            <div class="p-6 text-slate-900">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-slate-100">
                                <th class="pb-4 font-semibold text-slate-600 text-sm">Patient</th>
                                <th class="pb-4 font-semibold text-slate-600 text-sm">Doctor</th>
                                <th class="pb-4 font-semibold text-slate-600 text-sm">Service</th>
                                <th class="pb-4 font-semibold text-slate-600 text-sm">Date &amp; Time</th>
                                <th class="pb-4 font-semibold text-slate-600 text-sm">Status</th>
                                <th class="pb-4 font-semibold text-slate-600 text-sm text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse ($appointments as $appointment)
                                <tr class="group hover:bg-slate-50 transition-colors">
                                    <td class="py-4 text-sm text-slate-700">{{ $appointment->patient->name }}</td>
                                    <td class="py-4 text-sm text-slate-700">{{ $appointment->doctor->name }}</td>
                                    <td class="py-4 text-sm text-slate-700">{{ $appointment->service->name }}</td>
                                    <td class="py-4 text-sm text-slate-700">{{ $appointment->date->format('M d, Y h:i A') }}</td>
                                    <td class="py-4">
                                        <span @class([
                                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                                            'bg-amber-100 text-amber-800' => $appointment->status === 'pending',
                                            'bg-emerald-100 text-emerald-800' => $appointment->status === 'confirmed',
                                            'bg-rose-100 text-rose-800' => $appointment->status === 'cancelled',
                                        ])>
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 text-right">
                                        <div class="flex justify-end gap-3">
                                            <a href="{{ route('appointments.edit', $appointment) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                                Edit
                                            </a>
                                            @if ($appointment->status !== 'cancelled')
                                                <form method="POST" action="{{ route('appointments.destroy', $appointment) }}" onsubmit="return confirm('Cancel this appointment?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-rose-600 hover:text-rose-800 text-sm font-medium">
                                                        Cancel
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-sm text-slate-500">
                                        No appointments found.
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
