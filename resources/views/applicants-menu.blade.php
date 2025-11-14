@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-100">Daftar Pelamar</h1>
    </div>

    <!-- Applicants List Card -->
    <div class="bg-gray-800 rounded-lg shadow-lg">
        <div class="p-6">
            <p class="text-gray-300 mb-4">Kelola daftar pelamar yang tersedia.</p>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-300">NAMA PELAMAR</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-300">LOWONGAN</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-300">CV</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-300">STATUS</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-300">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applicants as $applicant)
                        <tr class="border-b border-gray-700 hover:bg-gray-700/50">
                            <td class="py-4 px-4 text-gray-200">{{ $applicant->user->name }}</td>
                            <td class="py-4 px-4 text-gray-200">{{ $applicant->vacancy->title }}</td>
                            <td class="py-4 px-4">
                                <a href="{{ asset('storage/' . $applicant->cv) }}" target="_blank" class="text-blue-400 hover:text-blue-300 hover:underline">
                                    Lihat CV
                                </a>
                            </td>
                            <td class="py-4 px-4">
                                @if($applicant->status == 'PENDING')
                                <span class="bg-yellow-500/20 text-gray-200 px-3 py-1 rounded-full text-sm font-medium">
                                    Pending
                                </span>
                                @elseif($applicant->status == 'CONFIRMED')
                                <span class="bg-green-500/20 text-gray-200   px-3 py-1 rounded-full text-sm font-medium">
                                    Terima
                                </span>
                                @elseif($applicant->status == 'REJECTED')
                                <span class="bg-red-500/20 text-red-300 px-3 py-1 rounded-full text-sm font-medium">
                                    Tolak
                                </span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex gap-2">
                                    @if($applicant->status == 'PENDING')
                                    <form action="{{ route('applications.accept', $applicant->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition duration-200">
                                            Terima
                                        </button>
                                    </form>
                                    <form action="{{  route('applications.reject', $applicant->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition duration-200">
                                            Tolak
                                        </button>
                                    </form>
                                    @endif
                                    <div>
                                        <button onclick="window.location='/applications/{{ $applicant->id }}/download-cv'" type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition duration-200">
                                            Download CV
                                        </button>
                                    </div>
                        
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 px-4 text-center text-gray-400">
                                Belum ada pelamar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection