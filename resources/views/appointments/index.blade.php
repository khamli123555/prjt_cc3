<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('app.appointment.title') }}
            </h2>
            <button type="button" @click="quickAddOpen = true" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-indigo-200">
                {{ __('app.appointment.new') }}
            </button>
        </div>
    </x-slot>

    <div
        class="space-y-6"
        x-data="{
            quickAddOpen: {{ $errors->any() && old('_from') === 'quick-add' ? 'true' : 'false' }},
            cancelOpen: false,
            cancelAction: '',
            search: '',
            loading: false,
            openCancelModal(action) {
                this.cancelAction = action;
                this.cancelOpen = true;
            },
            performSearch() {
                this.loading = true;
                axios.get('{{ route('appointments.search') }}', {
                    params: { q: this.search }
                })
                .then(response => {
                    document.getElementById('appointment-list').innerHTML = response.data;
                })
                .finally(() => {
                    this.loading = false;
                });
            }
        }"
    >
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
                 class="rounded-xl border border-emerald-100 bg-emerald-50 p-4 text-sm text-emerald-700 shadow-sm flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Search and Filter Bar -->
        <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" 
                       x-model="search" 
                       @input.debounce.300ms="performSearch()"
                       placeholder="{{ __('app.appointment.search_placeholder') ?? 'Search appointments...' }}"
                       class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent sm:text-sm transition-all">
                <div x-show="loading" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg class="animate-spin h-4 w-4 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm border border-slate-100 rounded-2xl">
            <div class="p-6 text-slate-900">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-separate border-spacing-y-2">
                        <thead>
                            <tr class="text-slate-500">
                                <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.appointment.patient') }}</th>
                                <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.appointment.doctor') }}</th>
                                <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.appointment.service') }}</th>
                                <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.appointment.date_time') }}</th>
                                <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider">{{ __('app.appointment.status') }}</th>
                                <th class="pb-4 px-2 font-semibold text-xs uppercase tracking-wider text-right">{{ __('app.appointment.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="appointment-list" class="divide-y divide-slate-50">
                            @include('appointments._list')
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $appointments->links() }}
                </div>
            </div>
        </div>

        <!-- Cancel Confirmation Modal -->
        <div x-show="cancelOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="cancelOpen = false"></div>
            <div class="relative z-10 w-full max-w-md rounded-2xl bg-white p-8 shadow-2xl border border-slate-100">
                <div class="w-12 h-12 bg-rose-50 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900">{{ __('app.modal.cancel_title') }}</h3>
                <p class="mt-2 text-slate-600">{{ __('app.modal.cancel_message') }}</p>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 rounded-xl transition-colors" @click="cancelOpen = false">
                        {{ __('app.buttons.close') }}
                    </button>
                    <form :action="cancelAction" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 rounded-xl bg-rose-600 text-white text-sm font-bold hover:bg-rose-700 shadow-lg shadow-rose-200 transition-all">
                            {{ __('app.buttons.confirm') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Quick Add Modal -->
        <div x-show="quickAddOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto">
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="quickAddOpen = false"></div>
            <div class="relative z-10 w-full max-w-3xl rounded-3xl bg-white shadow-2xl border border-slate-100 overflow-hidden">
                <div class="bg-indigo-600 p-6 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">{{ __('app.modal.quick_add_title') }}</h3>
                    <button type="button" class="text-indigo-200 hover:text-white transition-colors" @click="quickAddOpen = false">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('appointments.store') }}" class="p-8">
                    @csrf
                    <input type="hidden" name="_from" value="quick-add">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <x-input-label for="modal_user_id" :value="__('app.appointment.patient')" class="text-slate-700 font-bold" />
                            <select id="modal_user_id" name="user_id" class="block w-full rounded-xl border-slate-200 bg-slate-50 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                                <option value="">{{ __('app.appointment.select_patient') }}</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" @selected((string) old('user_id') === (string) $patient->id)>{{ $patient->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="modal_doctor_id" :value="__('app.appointment.doctor')" class="text-slate-700 font-bold" />
                            <select id="modal_doctor_id" name="doctor_id" class="block w-full rounded-xl border-slate-200 bg-slate-50 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                                <option value="">{{ __('app.appointment.select_doctor') }}</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" @selected((string) old('doctor_id') === (string) $doctor->id)>{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="modal_service_id" :value="__('app.appointment.service')" class="text-slate-700 font-bold" />
                            <select id="modal_service_id" name="service_id" class="block w-full rounded-xl border-slate-200 bg-slate-50 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                                <option value="">{{ __('app.appointment.select_service') }}</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" @selected((string) old('service_id') === (string) $service->id)>
                                        {{ $service->name }} ({{ $service->duration }} {{ __('app.units.minutes') }} - {{ __('app.units.currency') }}{{ number_format($service->price, 2) }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="modal_date" :value="__('app.appointment.date_time')" class="text-slate-700 font-bold" />
                            <x-text-input id="modal_date" name="date" type="datetime-local" class="block w-full rounded-xl border-slate-200 bg-slate-50" :value="old('date')" />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <x-input-label for="modal_status" :value="__('app.appointment.status')" class="text-slate-700 font-bold" />
                            <div class="flex flex-wrap gap-4">
                                @foreach(['pending', 'confirmed', 'cancelled'] as $status)
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="radio" name="status" value="{{ $status }}" @checked(old('status', 'pending') === $status) class="text-indigo-600 focus:ring-indigo-500 border-slate-300">
                                        <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors uppercase font-semibold">{{ __('app.status.' . $status) }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-10 flex justify-end gap-3">
                        <button type="button" class="px-6 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 rounded-xl transition-colors" @click="quickAddOpen = false">
                            {{ __('app.buttons.close') }}
                        </button>
                        <x-primary-button class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-200">
                            {{ __('app.buttons.create') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
