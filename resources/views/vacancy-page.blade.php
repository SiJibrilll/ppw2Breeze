@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    @if (Auth::user()->role == 'ADMIN')
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-100">Daftar Lowongan</h1>
            <a href="{{ route('vacancies.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                Tambah Lowongan
            </a>
        </div>
    @endif

    <!-- Job Listings Card -->
    <div class="bg-gray-800 rounded-lg shadow-lg">
        <div class="p-6">
            <p class="text-gray-300 mb-4">Lowongan kerja yang tersedia.</p>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-300">JUDUL</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-300">PERUSAHAAN</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-300">LOKASI</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-300">GAJI</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-300">LOGO</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-300">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jobs as $job)
                        <tr class="border-b border-gray-700">
                            <td class="py-4 px-4 text-gray-200">{{ $job->title }}</td>
                            <td class="py-4 px-4 text-gray-200">{{ $job->company }}</td>
                            <td class="py-4 px-4 text-gray-200">{{ $job->location }}</td>
                            <td class="py-4 px-4 text-gray-200">{{ number_format($job->salary, 0, ',', '.') }}</td>
                            <td class="py-4 px-4">
                                @if($job->logo)
                                <img src="{{ asset('storage/' . $job->logo) }}" alt="{{ $job->company }}" class="h-12 w-auto object-contain">
                                @else
                                <span class="text-gray-500 text-sm">No logo</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-gray-200 flex flex">
                                @if (Auth::user()->role == 'USER')
                                <a class="mx-2 bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition duration-200" href="{{ route('applications.create') }}?id={{ $job->id }}">Lamar</a>                                    
                                @endif
                               @if (Auth::user()->role == 'ADMIN')
                               <a class="mx-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition duration-200" href="{{ route('vacancies.edit', $job->id) }}">Edit</a>
                               <a class="mx-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition duration-200" href="{{ route('vacancies.export', $job->id) }}">Export daftar pelamar</a>
                               <form action="{{ route('vacancies.destroy', $job->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="mx-2 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition duration-200" href="{{ route('vacancies.destroy', $job->id) }}">Hapus</button>
                               </form>                                   
                               @endif

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 px-4 text-center text-gray-400">
                                Belum ada lowongan kerja. <a href="{{ route('vacancies.create') }}" class="text-blue-400 hover:underline">Tambah lowongan pertama</a>
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