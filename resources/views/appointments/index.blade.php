<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl heading-gradient leading-tight">
                {{ __('app.appointment.title') }}
            </h2>
            <!-- Add New Appointment Button - Fixed with Store + Debug -->
            <button type="button" 
                    @click="$store.app.quickAddOpen = true; console.log('Modal Button Clicked. New State:', $store.app.quickAddOpen)" 
                    class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-bold text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150 shadow-lg shadow-indigo-200">
                <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('app.appointment.new') }}
            </button>
        </div>
    </x-slot>

    <div
        class="space-y-6"
        x-data="{
            cancelOpen: false,
            cancelAction: '',
            openCancelModal(action) {
                this.cancelAction = action;
                this.cancelOpen = true;
            }
        }"
        x-init="if ({{ $errors->any() && old('_from') === 'quick-add' ? 'true' : 'false' }}) $store.app.quickAddOpen = true"
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

        @if ($errors->has('error'))
            <div class="rounded-xl border border-rose-100 bg-rose-50 p-4 text-sm text-rose-700 shadow-sm flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $errors->first('error') }}
            </div>
        @endif

        <!-- Axios Search Input -->
        <div class="glass-card p-6">
            <div class="max-w-md">
                <label for="search" class="block text-sm font-bold text-slate-700 mb-2">{{ __('Search Appointment') }}</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" id="search" placeholder="{{ __('app.appointment.search_placeholder') }}"
                           class="input-premium block w-full pl-12 pr-4 py-3 sm:text-sm">
                </div>
            </div>
        </div>

        <div class="glass-card overflow-hidden">
            <div class="p-8">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-slate-400 border-b border-slate-100">
                                <th class="pb-4 px-4 font-black text-xs uppercase tracking-widest">{{ __('app.appointment.patient') }}</th>
                                <th class="pb-4 px-4 font-black text-xs uppercase tracking-widest">{{ __('app.appointment.date_time') }}</th>
                                <th class="pb-4 px-4 font-black text-xs uppercase tracking-widest">{{ __('app.appointment.service') }}</th>
                            </tr>
                        </thead>
                        <tbody id="result" class="divide-y divide-slate-50">
                            @foreach ($appointments as $app)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="py-4 px-4 text-sm font-bold text-slate-900">{{ $app->patient->name }}</td>
                                    <td class="py-4 px-4 text-sm text-slate-600">{{ $app->date->format('Y-m-d H:i') }}</td>
                                    <td class="py-4 px-4 text-sm text-slate-600">{{ $app->service->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $appointments->links() }}
                </div>
            </div>
        </div>

        <!-- Quick Add Modal (Add Appointment) -->
        <div x-show="$store.app.quickAddOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto">
            <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="$store.app.quickAddOpen = false"></div>
            <div class="relative z-10 w-full max-w-2xl rounded-3xl bg-white shadow-2xl border border-slate-100 overflow-hidden">
                <div class="bg-indigo-600 p-6 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">{{ __('app.modal.quick_add_title') }}</h3>
                    <button type="button" class="text-indigo-200 hover:text-white transition-colors" @click="$store.app.quickAddOpen = false">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('appointments.store') }}" class="p-8">
                    @csrf
                    <input type="hidden" name="_from" value="quick-add">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700">{{ __('app.appointment.patient') }}</label>
                            <select name="user_id" class="input-premium block w-full">
                                <option value="">{{ __('app.appointment.select_patient') }}</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" @selected((string) old('user_id') === (string) $patient->id)>{{ $patient->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700">{{ __('app.appointment.doctor') }}</label>
                            <select name="doctor_id" class="input-premium block w-full">
                                <option value="">{{ __('messages.appointment.select_doctor') ?? __('app.appointment.select_doctor') }}</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" @selected((string) old('doctor_id') === (string) $doctor->id)>{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700">{{ __('app.appointment.service') }}</label>
                            <select name="service_id" class="input-premium block w-full">
                                <option value="">{{ __('app.appointment.select_service') }}</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" @selected((string) old('service_id') === (string) $service->id)>
                                        {{ $service->name }} ({{ $service->duration }} {{ __('app.units.minutes') }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700">{{ __('app.appointment.date_time') }}</label>
                            <input name="date" type="datetime-local" class="input-premium block w-full" value="{{ old('date') }}">
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-sm font-bold text-slate-700">{{ __('app.appointment.status') }}</label>
                            <div class="flex flex-wrap gap-4">
                                @foreach(['pending', 'confirmed', 'cancelled'] as $status)
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="radio" name="status" value="{{ $status }}" @checked(old('status', 'pending') === $status) class="w-5 h-5 text-indigo-600 focus:ring-indigo-500 border-slate-300 transition-all cursor-pointer">
                                        <span class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors uppercase font-bold tracking-wider">{{ __('app.status.' . $status) }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3">
                        <button type="button" class="px-6 py-3 text-sm font-bold text-slate-500 hover:bg-slate-100 rounded-2xl transition-all" @click="$store.app.quickAddOpen = false">
                            {{ __('app.buttons.close') }}
                        </button>
                        <button type="submit" class="btn-premium">
                            {{ __('app.buttons.create') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Axios Real-time Search Script -->
    <script>
    document.getElementById('search').addEventListener('keyup', function() {
        let query = this.value;

        axios.get('/appointments/search?q=' + query)
            .then(response => {
                let data = response.data;
                let table = '';

                data.forEach(app => {
                    table += `
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4 text-sm font-bold text-slate-900">${app.name}</td>
                            <td class="py-4 px-4 text-sm text-slate-600">${app.date}</td>
                            <td class="py-4 px-4 text-sm text-slate-600">${app.service}</td>
                        </tr>
                    `;
                });

                document.getElementById('result').innerHTML = table;
            });
    });
    </script>
</x-app-layout>
