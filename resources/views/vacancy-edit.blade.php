@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-100">Edit Lowongan</h1>
    </div>

    <!-- Edit Form Card -->
    <div class="bg-gray-800 rounded-lg shadow-lg max-w-4xl">
        <div class="p-6">
            <p class="text-gray-300 mb-6">Edit informasi lowongan kerja.</p>

            @if(session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-300 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('vacancies.update', $job->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul -->
                    <div>
                        <label for="title" class="block text-gray-300 font-medium mb-2">Judul</label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{ old('title', $job->title) }}"
                            required
                            class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="e.g. Project manager"
                        >
                    </div>

                    <!-- Perusahaan -->
                    <div>
                        <label for="company" class="block text-gray-300 font-medium mb-2">Perusahaan</label>
                        <input 
                            type="text" 
                            name="company" 
                            id="company" 
                            value="{{ old('company', $job->company) }}"
                            required
                            class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="e.g. Jasa raharja"
                        >
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label for="location" class="block text-gray-300 font-medium mb-2">Lokasi</label>
                        <input 
                            type="text" 
                            name="location" 
                            id="location" 
                            value="{{ old('location', $job->location) }}"
                            required
                            class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="e.g. Jakarta"
                        >
                    </div>

                    <!-- Gaji -->
                    <div>
                        <label for="salary" class="block text-gray-300 font-medium mb-2">Gaji</label>
                        <input 
                            type="number" 
                            name="salary" 
                            id="salary" 
                            value="{{ old('salary', $job->salary) }}"
                            required
                            min="0"
                            class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="e.g. 1000000"
                        >
                    </div>
                </div>

                <!-- Logo -->
                <div class="mt-6">
                    <label for="logo" class="block text-gray-300 font-medium mb-2">Logo Perusahaan</label>
                    
                    @if($job->logo)
                    <div class="mb-3 p-4 bg-gray-900 rounded-lg">
                        <p class="text-gray-400 text-sm mb-2">Logo saat ini:</p>
                        <img src="{{ asset('storage/' . $job->logo) }}" alt="{{ $job->company }}" class="h-16 w-auto object-contain">
                    </div>
                    @endif
                    
                    <input 
                        type="file" 
                        name="logo" 
                        id="logo" 
                        accept="image/*"
                        class="block w-full text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-medium file:bg-gray-700 file:text-gray-200 hover:file:bg-gray-600 file:cursor-pointer border border-gray-700 rounded-lg bg-gray-900 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <p class="mt-2 text-sm text-gray-400">Biarkan kosong jika tidak ingin mengubah logo. Format: JPG, PNG, GIF. Max: 2MB</p>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 mt-8">
                    <button 
                        type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200"
                    >
                        Simpan Perubahan
                    </button>
                    <a 
                        href="{{ route('vacancies.index') }}" 
                        class="bg-gray-700 hover:bg-gray-600 text-gray-200 px-6 py-2 rounded-lg font-medium transition duration-200"
                    >
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection