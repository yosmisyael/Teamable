<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $employeesCount = Employee::all()->count();
        $departments = Department::query()->withCount('employees')->orderBy('nama_departemen')->get();

        return view('departments.index', compact('departments', 'employeesCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_departemen' => 'required|unique:departments,nama_departemen|max:255',
        ]);

        Department::query()->create($validated);

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $department = Department::query()->findOrFail($id);

        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $department = Department::query()->findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'nama_departemen' => 'required|unique:departments,nama_departemen|max:255',
        ]);

        Department::query()->findOrFail($id)->update($validated);

        return redirect()->route('departments.show', ['department' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Department::query()->findOrFail($id)->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department with ID ' . $id . ' has been deleted successfully');
    }
}
