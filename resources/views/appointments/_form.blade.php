@php
    $selectedPatient = old('user_id', $appointment->user_id ?? '');
    $selectedDoctor = old('doctor_id', $appointment->doctor_id ?? '');
    $selectedService = old('service_id', $appointment->service_id ?? '');
    $selectedDate = old('date', isset($appointment) ? optional($appointment->date)->format('Y-m-d\TH:i') : '');
    $selectedStatus = old('status', $appointment->status ?? 'pending');
@endphp

<div class="glass-card p-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="space-y-2">
            <x-input-label for="user_id" :value="__('app.appointment.patient')" class="text-slate-700 font-bold ml-1" />
            <select id="user_id" name="user_id" class="input-premium block w-full">
                <option value="">{{ __('app.appointment.select_patient') }}</option>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}" @selected((string) $selectedPatient === (string) $patient->id)>
                        {{ $patient->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="doctor_id" :value="__('app.appointment.doctor')" class="text-slate-700 font-bold ml-1" />
            <select id="doctor_id" name="doctor_id" class="input-premium block w-full">
                <option value="">{{ __('app.appointment.select_doctor') }}</option>
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}" @selected((string) $selectedDoctor === (string) $doctor->id)>
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="service_id" :value="__('app.appointment.service')" class="text-slate-700 font-bold ml-1" />
            <select id="service_id" name="service_id" class="input-premium block w-full">
                <option value="">{{ __('app.appointment.select_service') }}</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" @selected((string) $selectedService === (string) $service->id)>
                        {{ $service->name }} ({{ $service->duration }} {{ __('app.units.minutes') }} - {{ __('app.units.currency') }}{{ number_format($service->price, 2) }})
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="date" :value="__('app.appointment.date_time')" class="text-slate-700 font-bold ml-1" />
            <x-text-input id="date" name="date" type="datetime-local" class="input-premium block w-full" :value="$selectedDate" />
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>

        <div class="md:col-span-2 space-y-4">
            <x-input-label for="status" :value="__('app.appointment.status')" class="text-slate-700 font-bold ml-1" />
            <div class="flex flex-wrap gap-6 bg-slate-50/50 p-6 rounded-3xl border border-slate-100">
                @foreach(['pending', 'confirmed', 'cancelled'] as $status)
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="radio" name="status" value="{{ $status }}" @checked($selectedStatus === $status) class="w-6 h-6 text-indigo-600 focus:ring-indigo-500 border-slate-300 transition-all cursor-pointer">
                        <span class="text-sm font-bold text-slate-600 group-hover:text-slate-900 transition-colors uppercase tracking-widest">{{ __('app.status.' . $status) }}</span>
                    </label>
                @endforeach
            </div>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>
    </div>

    <div class="flex items-center justify-end gap-6 mt-12 pt-8 border-t border-slate-100">
        <a href="{{ route('appointments.index') }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest">{{ __('app.buttons.back') }}</a>
        <button type="submit" class="btn-premium px-12 py-4 text-lg">
            {{ $submitLabel }}
        </button>
    </div>
</div>
