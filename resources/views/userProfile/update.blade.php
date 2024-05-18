<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> 
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200"> 
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <!-- Bio -->
                        <div class="mt-4">
                            <x-label for="bio" :value="__('Bio')" />

                            <x-input id="bio" class="block mt-1 w-full" type="text" name="bio" :value="$user->bio" required autofocus />
                        </div>

                        <!-- Location -->
                        <div class="mt-4">
                            <x-label for="location" :value="__('Location')" />

                            <x-input id="location" class="block mt-1 w-full" type="text" name="location" :value="$user->location" required />
                        </div>

                        <!-- Status -->
                        <div class="mt-4">
                            <x-label for="status" :value="__('Status')" />

                            <x-input id="status" class="block mt-1 w-full" type="checkbox" name="status" :value="$user->status" />
                        </div>

                        <!-- Job Description -->
                        <div class="mt-4">
                            <x-label for="jobDescription" :value="__('Job Description')" />

                            <x-input id="jobDescription" class="block mt-1 w-full" type="text" name="jobDescription" :value="$user->jobDescription" />
                        </div>

                        <!-- Graduation Year -->
                        <div class="mt-4">
                            <x-label for="graduationYear" :value="__('Graduation Year')" />

                            <x-input id="graduationYear" class="block mt-1 w-full" type="text" name="graduationYear" :value="$user->graduationYear"></x-input>
                            </div>
                        
                        </div>
                        </div>
                        </div>
                        </div>
                    </x-app-layout>