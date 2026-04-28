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
        $user = auth()->user();
        
        $appointments = Appointment::query()
            ->with(['patient', 'doctor', 'service'])
            ->when($user->role === 'doctor', function ($q) use ($user) {
                $q->where('doctor_id', $user->id);
            })
            ->when($user->role === 'patient', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
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
        try {
            $appointment = Appointment::create($request->validated());

            if ($appointment->status === 'confirmed') {
                Mail::to($appointment->patient->email)->send(new AppointmentConfirmed($appointment));
            }

            return redirect()
                ->route('appointments.index')
                ->with('success', __('app.flash.appointment_created'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Appointment Creation Failed: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Creation failed: ' . $e->getMessage()]);
        }
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
        $q = $request->q;
        $user = auth()->user();

        $appointments = Appointment::query()
            ->with(['patient', 'doctor', 'service'])
            ->when($user->role === 'doctor', function ($q) use ($user) {
                $q->where('doctor_id', $user->id);
            })
            ->when($user->role === 'patient', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->where(function ($sub) use ($q) {
                $sub->whereHas('patient', function ($query) use ($q) {
                    $query->where('name', 'like', "%$q%");
                })
                ->orWhereHas('service', function ($query) use ($q) {
                    $query->where('name', 'like', "%$q%");
                });
            })
            ->latest('date')
            ->get();

        $data = $appointments->map(function ($app) {
            return [
                'name' => $app->patient->name,
                'date' => $app->date->format('Y-m-d H:i'),
                'service' => $app->service->name,
            ];
        });

        return response()->json($data);
    }
}
