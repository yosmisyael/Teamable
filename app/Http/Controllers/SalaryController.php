<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $salaries = Salary::query()->with('employee')->get();

        return view('salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $employees = Employee::all();

        return view('salaries.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|integer|exists:employees,id',
            'bulan' => [
                'required',
                'date_format:Y-m',
                Rule::unique('salaries')->where(function ($query) use ($request) {
                    return $query->where('karyawan_id', $request->karyawan_id);
                }),
            ],
            'gaji_pokok' => 'required|decimal:0,2|min:0',
            'tunjangan'  => 'required|decimal:0,2|min:0',
            'potongan'   => 'required|decimal:0,2|min:0',
            'total_gaji' => 'required|decimal:0,2|min:0',
        ], [
            'bulan.unique' => 'A salary slip for this employee already exists for the selected month.'
        ]);
        Salary::query()->create($validated);
        return redirect()->route('salaries.index')
            ->with('success', 'salary slip has been saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $salary = Salary::query()->findOrFail($id);
        return view('salaries.show', compact('salary'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $salary = Salary::query()->findOrFail($id);
        return view('salaries.edit', compact('salary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'gaji_pokok' => 'required|decimal:0,2|min:0',
            'tunjangan'  => 'required|decimal:0,2|min:0',
            'potongan'   => 'required|decimal:0,2|min:0',
            'total_gaji' => 'required|decimal:0,2|min:0',
        ]);

        Salary::query()->findOrFail($id)->update($validated);

        return redirect()->route('salaries.show', $id)
            ->with('success', 'Salary slip updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Salary::query()->findOrFail($id)->delete();

        return redirect()->route('salaries.index')
            ->with('success', 'Salary record has been deleted.');
    }
}
