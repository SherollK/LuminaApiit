@props(['event'])
<article {{ $attributes->merge(['class' => '[&:not(:last-child)]:border-b border-gray-100 pb-10']) }}>
    <div class="article-body grid grid-cols-12 gap-3 mt-5 items-start px-10">
        <div class="article-thumbnail col-span-4 flex items-center">
            <a wire:navigate href="{{ route('events.show', $event->slug)}}">
                <img class="mw-100 mx-auto rounded-xl" src="{{ $event->getThumbnailUrl()}}" alt="thumbnail">
            </a>
        </div>
        <div class="col-span-8">
            <h2 class="text-xl font-bold text-gray-900">
                <a wire:navigate href="{{ route('events.show', $event->slug)}}">
                    {{$event->title}}
                </a>
            </h2>
            <div class="article-meta flex py-1 text-sm items-center">
                <x-posts.author :author="$event->author" size="xs" />
            </div>
            <h3 class="mt-2 text-base text-gray-800 font-semi-bold flex gap-5">
                <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">{{$event->date}}</span>
                <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">{{$event->time}}</span>
                <span class="inline-flex items-center rounded-md bg-purple-50 px-2 py-1 text-xs font-medium text-purple-700 ring-1 ring-inset ring-purple-700/10">{{$event->location}}</span>
            </h3>
            <p class="mt-2 text-sm text-gray-600 font-light">
                {{$event->getExcerpt()}}
            </p>
        </div>
    </div>
</article>
