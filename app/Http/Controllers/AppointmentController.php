<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use App\Mail\AppointmentConfirmed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the appointments.
     */
    public function index(): View
    {
        $appointments = Appointment::query()
            ->with(['patient', 'doctor', 'service'])
            ->latest('date')
            ->paginate(10);

        return view('appointments.index', [
            'appointments' => $appointments,
            'patients' => User::query()->where('role', 'patient')->orderBy('name')->get(),
            'doctors' => User::query()->where('role', 'doctor')->orderBy('name')->get(),
            'services' => Service::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new appointment.
     */
    public function create(): View
    {
        return view('appointments.create', [
            'patients' => User::query()->where('role', 'patient')->orderBy('name')->get(),
            'doctors' => User::query()->where('role', 'doctor')->orderBy('name')->get(),
            'services' => Service::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        $appointment = Appointment::create($request->validated());

        if ($appointment->status === 'confirmed') {
            Mail::to($appointment->patient->email)->send(new AppointmentConfirmed($appointment));
        }

        return redirect()
            ->route('appointments.index')
            ->with('success', __('app.flash.appointment_created'));
    }

    /**
     * Show the form for editing the specified appointment.
     */
    public function edit(Appointment $appointment): View
    {
        return view('appointments.edit', [
            'appointment' => $appointment,
            'patients' => User::query()->where('role', 'patient')->orderBy('name')->get(),
            'doctors' => User::query()->where('role', 'doctor')->orderBy('name')->get(),
            'services' => Service::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified appointment in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        $appointment->update($request->validated());

        return redirect()
            ->route('appointments.index')
            ->with('success', __('app.flash.appointment_updated'));
    }

    /**
     * Cancel the specified appointment.
     */
    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->update(['status' => 'cancelled']);

        return redirect()
            ->route('appointments.index')
            ->with('success', __('app.flash.appointment_cancelled'));
    }

    /**
     * Search appointments.
     */
    public function search(\Illuminate\Http\Request $request)
    {
        $query = $request->get('q');

        $appointments = Appointment::query()
            ->with(['patient', 'doctor', 'service'])
            ->when($query, function ($q) use ($query) {
                $q->whereHas('patient', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                })
                ->orWhereHas('doctor', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                })
                ->orWhere('date', 'like', "%{$query}%");
            })
            ->latest('date')
            ->get();

        return view('appointments._list', compact('appointments'))->render();
    }
}
