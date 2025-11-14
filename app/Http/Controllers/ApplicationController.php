<?php

namespace App\Http\Controllers;

use App\Exports\ApplicationExport;
use App\Models\Application;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ApplicationController extends Controller
{
    function index() {
        $applications = Application::with(['user', 'vacancy'])->get();

        return view('applicants-menu', [
            'applicants' => $applications
        ]);
    }

    function create(Request $request) {
        if (!$request->get('id')) {
            return redirect(route('vacancies.index'));
        }

        $vacancy = Vacancy::findOrFail($request->get('id'));

        if (!$vacancy) {
            return redirect(route('vacancies.index'));
        }

        return view('application-form', [
            'job' => $vacancy
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'cv' => ['required', 'file', 'mimes:pdf'],
            'vacancy_id' => ['required', 'integer', 'exists:vacancies,id']
        ]);

        $cvPath = $request->file('cv')->store('cvs', 'public');

        $request->user()->applications()->create([
            'cv' => $cvPath,
            'vacancy_id' => $validated['vacancy_id']
        ]);

        return redirect(route('vacancies.index'))->with('success', 'Lamaran berhasil dikirim!');
    }

    function accept(Application $application) {
        $application->status = "CONFIRMED";
        $application->update();
        
        return redirect()->back()->with('success', 'Pelamar berhasil diterima!');
    }

    function reject(Application $application) {
        $application->status = "REJECTED";
        $application->update();
        
        return redirect()->back()->with('success', 'Pelamar berhasil ditolak!');
    }

    function export() {
        return Excel::download(new ApplicationExport, 'applications.xlsx');
    }

    function downloadCV(Application $application) {
        return Storage::disk('public')->download($application->cv);
    }
}
