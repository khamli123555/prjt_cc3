<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatientController extends Controller
{
    /**
     * Display a listing of patients.
     */
    public function index(): View
    {
        $patients = User::query()
            ->where('role', 'patient')
            ->orderBy('name')
            ->paginate(12);

        return view('patients.index', compact('patients'));
    }

    /**
     * Display the history of appointments for a patient.
     */
    public function history(User $user): View
    {
        abort_if($user->role !== 'patient', 404);

        $appointments = $user->appointments()
            ->with(['doctor', 'service'])
            ->latest('date')
            ->paginate(10);

        return view('patients.history', compact('user', 'appointments'));
    }
}
