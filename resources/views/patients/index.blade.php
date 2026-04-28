<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('app.patient.list') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm border border-slate-100 rounded-2xl">
        <div class="p-6 text-slate-900">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-2">
                    <thead>
                        <tr class="text-slate-500">
                            <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.patient.name') }}</th>
                            <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.patient.email') }}</th>
                            <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider text-right">{{ __('app.appointment.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($patients as $patient)
                            <tr class="group hover:bg-slate-50 transition-colors">
                                <td class="py-4 px-2 text-sm text-slate-700 font-medium">{{ $patient->name }}</td>
                                <td class="py-4 px-2 text-sm text-slate-700">{{ $patient->email }}</td>
                                <td class="py-4 px-2 text-right">
                                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('patients.history', $patient) }}" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Historique">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </a>
                                        <a href="#" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-12 text-center text-slate-500">
                                    {{ __('app.patient.empty') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $patients->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
