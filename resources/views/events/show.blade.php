<x-app-layout>
    {{-- This file indicates the actual structure of the post when you open it --}}
        <article class="col-span-4 md:col-span-3 mt-10 mx-auto py-5 w-full" style="max-width:700px">
            <img class="w-full my-2 rounded-lg" src="{{ $events->getThumbnailUrl() }}" alt="thumbnail">
            <h1 class="text-4xl font-bold text-left text-gray-800">
                {{ $events->title }}
            </h1>
        
            <div class="mt-2 flex justify-between items-center">
                <div class="flex py-5 text-base items-center">
                    <x-posts.author :author="$events->author" size="lg" />
                   
          
               
                </div>
                {{-- <div class="flex items-center"> --}}
                    {{-- <span class="text-gray-500 mr-2">{{ $post->published_at->diffForHumans() }}</span> --}}
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.3"
                        stroke="currentColor" class="w-5 h-5 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div> --}}
            </div>
    
            
            {{-- <div
                class="article-actions-bar my-6 flex text-sm items-center justify-between border-t border-b border-gray-100 py-4 px-2">
                <div class="flex items-center">
                    <livewire:like-button :key="'like-' . $post->id" :$post />
                </div>
                <div>
                    <div class="flex items-center">
    
                    </div>
                </div>
            </div> --}}
    
            <div class="article-content py-3 text-gray-800 text-lg prose text-justify">
                {!! $events->description !!}
            </div>

            <div class="flex gap-5 items-start my-10">
                    <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-md font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">{{ $events->date }}</span>
                    <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-md font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">{{ $events->location }}</span>
                    <span class="inline-flex items-center rounded-md bg-purple-50 px-2 py-1 text-md font-medium text-purple-700 ring-1 ring-inset ring-purple-700/10">{{ $events->time }}</span>
     
            </div>
{{--     
            <div class="flex items-center space-x-4 mt-10">
                @foreach ($events->categories as $category)
                    <x-posts.category-badge :category="$category" />
                @endforeach
            </div> --}}
    
    
        </article>
    
    </x-app-layout>
    