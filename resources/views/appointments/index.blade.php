<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Appointments') }}
            </h2>
            <button class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-indigo-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Appointment
            </button>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <p class="text-sm font-medium text-slate-500 mb-1">Total Appointments</p>
                <h3 class="text-2xl font-bold text-slate-900">24</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm border-l-4 border-l-indigo-500">
                <p class="text-sm font-medium text-slate-500 mb-1">Upcoming Today</p>
                <h3 class="text-2xl font-bold text-slate-900">8</h3>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <p class="text-sm font-medium text-slate-500 mb-1">Cancelled</p>
                <h3 class="text-2xl font-bold text-slate-900">2</h3>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white overflow-hidden shadow-sm border border-slate-100 rounded-2xl">
            <div class="p-6 text-slate-900">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-slate-100">
                                <th class="pb-4 font-semibold text-slate-600 text-sm">Patient Name</th>
                                <th class="pb-4 font-semibold text-slate-600 text-sm">Doctor</th>
                                <th class="pb-4 font-semibold text-slate-600 text-sm">Date & Time</th>
                                <th class="pb-4 font-semibold text-slate-600 text-sm">Status</th>
                                <th class="pb-4 font-semibold text-slate-600 text-sm text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <tr class="group hover:bg-slate-50 transition-colors">
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold">JD</div>
                                        <div>
                                            <p class="font-bold text-slate-900 text-sm">John Doe</p>
                                            <p class="text-xs text-slate-500">P-12345</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 text-sm text-slate-600">Dr. Sarah Smith</td>
                                <td class="py-4 text-sm text-slate-600">2026-04-28 | 10:00 AM</td>
                                <td class="py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        Confirmed
                                    </span>
                                </td>
                                <td class="py-4 text-right">
                                    <button class="text-slate-400 hover:text-indigo-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            <tr class="group hover:bg-slate-50 transition-colors">
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold">AJ</div>
                                        <div>
                                            <p class="font-bold text-slate-900 text-sm">Alice Johnson</p>
                                            <p class="text-xs text-slate-500">P-12346</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 text-sm text-slate-600">Dr. Robert Brown</td>
                                <td class="py-4 text-sm text-slate-600">2026-04-28 | 11:30 AM</td>
                                <td class="py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                        Pending
                                    </span>
                                </td>
                                <td class="py-4 text-right">
                                    <button class="text-slate-400 hover:text-indigo-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
