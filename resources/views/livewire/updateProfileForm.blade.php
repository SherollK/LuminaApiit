<div>
    <div class="col-span-6 sm:col-span-4">
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
    
</div>