<!-- create-post.blade.php -->
@php
use App\Models\Category;
    
@endphp

<div class="w-full">
    <form wire:submit.prevent="save" class="max-w-md mx-auto">
    <p class="py-8 font-bold text-xl">Create a Post </p>
       
        <div class="mb-4">
            <label for="title" class="block font-bold text-gray-700 ">Title</label>
            <input wire:model="title" id="title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="sub_title" class="block font-bold text-gray-700">Sub Title</label>
            <input wire:model="sub_title" id="sub_title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('sub_title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="body" class="block font-bold text-gray-700">Body</label>
            <textarea wire:model="body" id="body" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('body') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <x-label for="categories" value="{{ __('Add relavant categories') }}" />
            <div>
                @foreach (Category::all() as $category)
                    <label class="inline-flex items-center mt-3">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-checkbox h-5 w-5 text-indigo-600">
                        <span class="ml-2">{{ $category->title }}</span>
                    </label>
                @endforeach
            </div>
        </div>
        
        

        
{{-- 
        <div class="mb-4">
            <label for="featured" class="inline-flex items-center">
                <input wire:model="featured" id="featured" type="checkbox" class="form-checkbox" />
                <span class="ml-2">Featured</span>
            </label>
        </div> --}}

        <div class="mb-4">
            <label for="image" class="block text-lg font-medium text-gray-700">Image</label>
            <input type="file" wire:model="image" id="image" class="mt-1 block w-full text-gray-700">
            @if ($image)
                <div class="mt-2">
                    <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="max-h-64 object-cover rounded">
                </div>
            @endif
            @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- input field to add categories --}}
       

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Save Post
            </button>
        </div>


    </form>
</div>

{{-- <div>
    <form wire:submit.prevent="create">
        {{ $this->form }}

        <button type="submit">
            Submit
        </button>
    </form>

    <x-filament-actions::modals />
</div>
 --}}



{{-- 
$table->id();
$table->foreignIdFor(User::class);

$table->string('image')->nullable();
$table->string('title');
$table->string('sub_title');
$table->string('slug')->unique();
$table->text('body');

$table->timestamp('published_at')->nullable();
$table->boolean('featured')->default(false);

$table->softDeletes();

$table->timestamps(); --}}
