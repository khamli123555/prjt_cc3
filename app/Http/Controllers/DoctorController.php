<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorController extends Controller
{
    /**
     * Display a listing of doctors.
     */
    public function index(): View
    {
        $doctors = User::query()
            ->where('role', 'doctor')
            ->orderBy('name')
            ->paginate(12);

        return view('doctors.index', compact('doctors'));
    }
}
?>
