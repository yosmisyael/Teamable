<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $attendances = Attendance::all();
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $employees = Employee::all();
        return view('attendances.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'karyawan_id' => ['required', 'integer', 'exists:employees,id'],
            'tanggal' => ['required', 'date'],
            'waktu_masuk' => ['nullable', 'date_format:H:i'],
            'waktu_keluar' => ['nullable', 'date_format:H:i', 'after:waktu_masuk'],
            'status_absensi' => ['required', 'string', Rule::in(['hadir', 'izin', 'sakit', 'alpha'])],
        ]);

        Attendance::query()->create($validated);

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance successfully recorded.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $attendance = Attendance::query()->findOrFail($id);

        return view('attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $employees = Employee::all();

        $attendance = Attendance::query()->with('employee')->findOrFail($id);

        return view('attendances.edit', compact('attendance', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'waktu_masuk' => ['nullable', 'date_format:H:i'],
            'waktu_keluar' => ['nullable', 'date_format:H:i', 'after:waktu_masuk'],
            'status_absensi' => ['required', 'string', Rule::in(['hadir', 'izin', 'sakit', 'alpha'])],
        ]);

        Attendance::query()->findOrFail($id)->update($validated);

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance record successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Attendance::query()->findOrFail($id)->delete();
        return redirect()->route('attendances.index')
            ->with('success', 'Attendance record successfully deleted.');
    }
}
