{{-- HAs all the implementation of the functionality of the class and the UI is designed here --}}
{{-- 

<div class=" px-3 lg:px-7 py-6"> --}}
    {{-- <div class="flex justify-between items-center border-b border-gray-100">
        {{-- <div class="text-gray-600"> --}}

            {{-- no active filter situation no need of this --}}
                {{-- @if ($this->activeCategory || $search)
                    <button class="gray-500 text-xs mr-3" wire:click="clearFilters()">X</button>
                @endif --}}

             {{-- no search or filter yet so no need    --}}
                {{-- @if ($this->activeCategory)
                    <x-badge wire:navigate href="{{ route('posts.index', ['category' => $this->activeCategory->slug]) }}"
                        :textColor="$this->activeCategory->text_color" :bgColor="$this->activeCategory->bg_color">
                        {{ $this->activeCategory->title }}
                    </x-badge>
                @endif
                @if ($search)
                <span class="ml-2">
                    containing : <strong>{{ $search }}</strong>
                </span>
                @endif --}}


        {{-- </div> --}}

        {{-- no need for latest and oldest in events so no need --}}
            {{-- <div class="flex items-center space-x-4 font-light ">
                <button class="{{ $sort === 'desc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4"
                    wire:click="setSort('desc')">Latest</button>
                <button class="{{ $sort === 'asc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4 "
                    wire:click="setSort('asc')">Oldest</button>
            </div> --}}


    {{-- </div> --}} 
    {{-- <div class="py-4">
        @foreach ($this->events as $event)
            <x-events.events-item wire:key="{{$event->id}}" :event="$event" />
        @endforeach
    </div>

    <div class="my-3">
        {{ $this->events->onEachSide(1)->links() }}
    </div>
</div> --}}




        <span class="py-10 block"> 
            @foreach ($this->events as $event)
                <x-events.events-item wire:key="{{$event->id}}" :event="$event" />
                
            @endforeach 
            <br>
                </span>

     
    


