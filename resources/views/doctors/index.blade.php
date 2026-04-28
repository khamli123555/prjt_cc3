<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('app.doctor.list') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm border border-slate-100 rounded-2xl">
        <div class="p-6 text-slate-900">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-2">
                    <thead>
                        <tr class="text-slate-500">
                            <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.doctor.name') }}</th>
                            <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.doctor.email') }}</th>
                            <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.doctor.specialty') }}</th>
                            <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider text-right">{{ __('app.appointment.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($doctors as $doctor)
                            <tr class="group hover:bg-slate-50 transition-colors">
                                <td class="py-4 px-2 text-sm text-slate-700 font-medium">{{ $doctor->name }}</td>
                                <td class="py-4 px-2 text-sm text-slate-700">{{ $doctor->email }}</td>
                                <td class="py-4 px-2 text-sm text-slate-700">{{ $doctor->specialty ?? 'Generalist' }}</td>
                                <td class="py-4 px-2 text-right">
                                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
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
                                <td colspan="4" class="py-12 text-center text-slate-500">
                                    {{ __('app.doctor.empty') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $doctors->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
