<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Appointment') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf
                    @include('appointments._form', ['submitLabel' => 'Create Appointment'])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
