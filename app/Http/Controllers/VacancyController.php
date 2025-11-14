<?php

namespace App\Http\Controllers;

use App\Exports\VacancyApplicantsExport;
use App\Exports\VacancyTemplateExport;
use App\Imports\VacancyImport;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vacancies = Vacancy::with('applications')->get();

        return view('vacancy-page', [
            'jobs' => $vacancies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('import-vacancy');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacancy $vacancy)
    {
        return view('vacancy-edit', [
            'job' => $vacancy
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

    // Handle logo upload
    if ($request->hasFile('logo')) {
        // Delete old logo if exists
        if ($vacancy->logo) {
            
            Storage::delete('public/' . $vacancy->logo);
        }
        
        $logoPath = $request->file('logo')->store('logos', 'public');
        $validated['logo'] = $logoPath;
    }

    $vacancy->update($validated);

    return redirect()->route('vacancies.index')->with('success', 'Lowongan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();
        return redirect()->back()->with('success', 'Lowongan berhasil dihapus');
    }

    function import(Request $request) {
        $validated = $request->validate([
            'lamaran' => ['required', 'file', 'mimes:xlsx,csv']
        ]);

        Excel::import(new VacancyImport, $request->file('lamaran'));

        return redirect('/vacancies')->with('success', 'Lamaran berhasil didaftarkan');
    }

    function template() {
        return Excel::download(new VacancyTemplateExport, 'vacancy_template.xlsx');
    }

    function exportApplicants(Vacancy $vacancy) {
        return Excel::download(new VacancyApplicantsExport($vacancy),
        "Daftar pelamar $vacancy->title $vacancy->company" . ".xlsx");
    }
}
