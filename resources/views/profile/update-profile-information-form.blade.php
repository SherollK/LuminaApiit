<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />


            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>


         <div class="col-span-6 sm:col-span-4">
          


            <div class="container mx-auto px-4">
                @livewire('updateProfileForm')
            </div>
            
    
        </div>

{{-- 
        Profile actions --}}
        {{-- <div class="col-span-6 sm:col-span-4">
            <x-label for="jobDescription" value="{{ __('Job Description') }}" />
            <x-input id="jobDescription" type="text" class="mt-1 block w-full" wire:model="state.jobDescription" required />
            <x-input-error for="jobDescription" class="mt-2" />
        </div>
        
        <div class="col-span-6 sm:col-span-4">
            <x-label for="level" value="{{ __('Level') }}" />
            <select id="level" wire:model="state.level" class="mt-1 block w-full">
                <option value="null">Select Level</option>
                <option value="level3">Level 3 (Foundation)</option>
                <option value="level4">Level 4 (First Year)</option>
                <option value="level5">Level 5 (Second Year)</option>
                <option value="level6">Level 6 (Third Year)</option>
            </select>
            <x-input-error for="level" class="mt-2" />
        </div>
        
        <div class="col-span-6 sm:col-span-4">
            <x-label for="location" value="{{ __('Location') }}" />
            <x-input id="location" type="text" class="mt-1 block w-full" wire:model="state.location" required />
            <x-input-error for="location" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="bio" value="{{ __('Bio') }}" />
            <textarea id="bio" class="mt-1 block w-full" wire:model="state.bio" rows="3"></textarea>
            <x-input-error for="bio" class="mt-2" />
        </div>



        <div class="col-span-6 sm:col-span-4">
            <x-button wire:click="updateProfile">
                {{ __('Update Profile') }}
            </x-button>
        </div>
        --}}

      

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
