@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-100">Submit CV</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Job Details Card -->
        <div class="bg-gray-800 rounded-lg shadow-lg">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-100 mb-4">Job Details</h2>
                
                <div class="space-y-4">
                    <!-- Job Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Position</label>
                        <p class="text-gray-200 text-lg font-medium">{{ $job->title }}</p>
                    </div>

                    <!-- Company -->
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Company</label>
                        <div class="flex items-center gap-3">
                            @if($job->logo)
                            <img src="{{ asset('storage/' . $job->logo) }}" alt="{{ $job->company }}" class="h-10 w-10 object-contain">
                            @endif
                            <p class="text-gray-200">{{ $job->company }}</p>
                        </div>
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Location</label>
                        <p class="text-gray-200">{{ $job->location }}</p>
                    </div>

                    <!-- Salary -->
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Salary</label>
                        <p class="text-gray-200">Rp {{ number_format($job->salary, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload Form Card -->
        <div class="bg-gray-800 rounded-lg shadow-lg">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-100 mb-4">Upload Your CV</h2>
                <p class="text-gray-300 mb-6">Upload your CV in PDF format to apply for this position.</p>

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

                <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="text" hidden value="{{ $job->id }}" name="vacancy_id">
                    {{-- <!-- Name Input -->
                    <div class="mb-6">
                        <label for="name" class="block text-gray-300 font-medium mb-2">Full Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            required
                            value="{{ old('name') }}"
                            class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter your full name"
                        >
                    </div>

                    <!-- Email Input -->
                    <div class="mb-6">
                        <label for="email" class="block text-gray-300 font-medium mb-2">Email Address</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            required
                            value="{{ old('email') }}"
                            class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="your.email@example.com"
                        >
                    </div> --}}

                    <!-- File Input -->
                    <div class="mb-6">
                        <label for="cv" class="block text-gray-300 font-medium mb-3">CV (PDF only)</label>
                        
                        <div class="relative">
                            <input 
                                type="file" 
                                name="cv" 
                                id="cv" 
                                accept=".pdf,application/pdf"
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
                            Submit CV
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