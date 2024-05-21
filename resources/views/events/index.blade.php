<x-app-layout>
   
    {{-- This shows the actual scroll list of the events --}}
        <div class="w-full grid grid-cols-1 gap-10 flex-col flex-wrap">
            {{-- The inner box --}}
            <div class="flex-col flex-wrap">
                {{-- Livewire components --}}
                <livewire:events-list />
            </div>
            {{-- Do we need a side blog for this? --}}
            {{-- Add the side blog after you made the events to categorise them after binding with categories --}}
            {{-- <div id="side-bar"
                class="border-t border-t-gray-100 md:border-t-none col-span-4 md:col-span-1 px-3 md:px-6  space-y-10 py-6 pt-10 md:border-l border-gray-100 h-screen sticky top-0">
                <livewire:search-box />
                @include('posts.partials.categories-box')
            </div> --}}
        </div>
    </x-app-layout>