@php
    $selectedPatient = old('user_id', $appointment->user_id ?? '');
    $selectedDoctor = old('doctor_id', $appointment->doctor_id ?? '');
    $selectedService = old('service_id', $appointment->service_id ?? '');
    $selectedDate = old('date', isset($appointment) ? optional($appointment->date)->format('Y-m-d\TH:i') : '');
    $selectedStatus = old('status', $appointment->status ?? 'pending');
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <x-input-label for="user_id" :value="__('app.appointment.patient')" />
        <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">{{ __('app.appointment.select_patient') }}</option>
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}" @selected((string) $selectedPatient === (string) $patient->id)>
                    {{ $patient->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="doctor_id" :value="__('app.appointment.doctor')" />
        <select id="doctor_id" name="doctor_id" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">{{ __('app.appointment.select_doctor') }}</option>
            @foreach ($doctors as $doctor)
                <option value="{{ $doctor->id }}" @selected((string) $selectedDoctor === (string) $doctor->id)>
                    {{ $doctor->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('doctor_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="service_id" :value="__('app.appointment.service')" />
        <select id="service_id" name="service_id" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">{{ __('app.appointment.select_service') }}</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}" @selected((string) $selectedService === (string) $service->id)>
                    {{ $service->name }} ({{ $service->duration }} {{ __('app.units.minutes') }} - {{ __('app.units.currency') }}{{ number_format($service->price, 2) }})
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="date" :value="__('app.appointment.date_time')" />
        <x-text-input id="date" name="date" type="datetime-local" class="block mt-1 w-full" :value="$selectedDate" />
        <x-input-error :messages="$errors->get('date')" class="mt-2" />
    </div>

    <div class="md:col-span-2">
        <x-input-label for="status" :value="__('app.appointment.status')" />
        <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
            <option value="pending" @selected($selectedStatus === 'pending')>{{ __('app.status.pending') }}</option>
            <option value="confirmed" @selected($selectedStatus === 'confirmed')>{{ __('app.status.confirmed') }}</option>
            <option value="cancelled" @selected($selectedStatus === 'cancelled')>{{ __('app.status.cancelled') }}</option>
        </select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>
</div>

<div class="flex items-center justify-end gap-3 mt-6">
    <a href="{{ route('appointments.index') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('app.buttons.back') }}</a>
    <x-primary-button>{{ $submitLabel }}</x-primary-button>
</div>
