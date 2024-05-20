@php
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Category;

@endphp

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            {{-- Role --}}
            <div class="mt-4">
                <x-label for="role" value="{{ __('Role') }}" />
                <select id="role" class="block mt-1 w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" type="role" :value="old('role')"  name="role" required>
                    <option>Select</option>
                     @foreach (User::getAvailableRoles() as $value => $label)
                     <option value="{{ $value }}">{{ $label }}</option>
                     @endforeach
                </select>
            </div>
            {{-- After this a[[;y these in the form submission controller]] --}}



            {{-- Graduated YEar --}}
            <div class="mt-4">
                <x-label for="date" value="{{ __('Graduating/Graduated Year') }}" />
                <input id="graduatingYear" type="month" name="graduatingYear" class="block mt-1 w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
            </div>

            {{-- Associated Campus --}}
            <div class="mt-4">
                <x-label for="location" value="{{ __('Associated Apiit Branch') }}" />
                <select id="location" class="block mt-1 w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"  :value="old('location')"  name="location" required>
                    <option>Select</option>
                     @foreach (UserProfile::getLocation() as $value => $label)
                     <option value="{{ $value }}">{{ $label }}</option>
                     @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-label for="levels" value="{{ __('Level of study') }}" />
                <select id="level" class="block mt-1 w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" :value="old('level')"  name="level" required>
                    <option>Select</option>
                     @foreach (UserProfile::getLevels() as $value => $label)
                     <option value="{{ $value }}">{{ $label }}</option>
                     @endforeach
                </select>
            </div>

            {{-- ASk for job description --}}
            <div class="mt-4">
                <x-label for="job_description" value="{{ __('Describe your current position') }}" />
                <input id="job_description" type="text" name="job_description" class="block mt-1 w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
            </div>


            {{-- Bio --}}
         <div class="mt-4">
              <x-label for="bio" value="{{ __('Tell us a bit about yourself (Your Bio)') }}" />
               <textarea id="bio" name="bio" rows="4" class="block mt-1 w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"></textarea>
          </div>


          {{-- Pick categories --}}
          <div class="mt-4">
            <x-label for="interests" value="{{ __('Select Interested Categories') }}" />
            <div>
                @foreach (Category::getCategoryList() as $category)
                    <label class="inline-flex items-center mt-3">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-checkbox h-5 w-5 text-indigo-600">
                        <span class="ml-2">{{ $category->title }}</span>
                    </label>
                @endforeach
            </div>
        </div>














            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
