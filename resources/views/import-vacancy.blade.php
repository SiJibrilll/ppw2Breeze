@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-100">Import Lowongan</h1>
            <a href="{{ route('vacancies.template') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                Download Template
            </a>
        </div>
    <!-- Upload Form Card -->
    <div class="bg-gray-800 rounded-lg shadow-lg max-w-2xl">
        <div class="p-6">
            <p class="text-gray-300 mb-6">Upload daftar lamaran yang tersedia</p>

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

            <form action="{{ route('vacancies.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- File Input -->
                <div class="mb-6">
                    <label for="lamaran" class="block text-gray-300 font-medium mb-3">Lamaran (Excell only)</label>
                    
                    <div class="relative">
                        <input 
                            type="file" 
                            name="lamaran" 
                            id="lamaran" 
                            accept=".xlsx,application/xlsx"
                            required
                            class="block w-full text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-medium file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:cursor-pointer border border-gray-700 rounded-lg bg-gray-900 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <p class="mt-2 text-sm text-gray-400">Maximum file size: 5MB</p>
                    
                    <!-- File preview -->
                    <div id="file-info" class="hidden mt-3 p-3 bg-gray-700 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                                </svg>
                                <span id="file-name" class="text-gray-300 text-sm"></span>
                            </div>
                            <span id="file-size" class="text-gray-400 text-sm"></span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex gap-3">
                    <button 
                        type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200"
                    >
                        Import lamaran
                    </button>
                    <a 
                        href="{{ route('vacancies.index') }}" 
                        class="bg-gray-700 hover:bg-gray-600 text-gray-200 px-6 py-2 rounded-lg font-medium transition duration-200"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // File input preview
    document.getElementById('cv').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const fileInfo = document.getElementById('file-info');
        const fileName = document.getElementById('file-name');
        const fileSize = document.getElementById('file-size');
        
        if (file) {
            fileName.textContent = file.name;
            fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            fileInfo.classList.remove('hidden');
        } else {
            fileInfo.classList.add('hidden');
        }
    });
</script>
@endsection