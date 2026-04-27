<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('app.appointment.edit') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form method="POST" action="{{ route('appointments.update', $appointment) }}">
                    @csrf
                    @method('PUT')
                    @include('appointments._form', ['submitLabel' => __('app.buttons.update')])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
