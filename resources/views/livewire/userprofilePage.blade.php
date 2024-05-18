
<main class="profile-page">

  <section class="relative block h-500-px bg-[#349eeb] py-20">
    <div class="w-full h-full bg-center bg-cover">
      <span id="blackOverlay" class="w-full h-full opacity-50 bg-[#349eeb]"></span>
    </div>

    <div class="w-full h-70-px">
      <div class="my-30 h-100px"></div>
      <svg class="w-full h-full fill-current text-blueGray-200" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
        <polygon points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </section>

  <section class=" py-16 bg-blueGray-200">
    <div class="container mx-auto px-4">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
        <div class="px-6">
          <div class="flex flex-wrap justify-center">
            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
              <div class="relative mt-6">
                <img alt="" src="{{$user->profile_photo_url}}" class="shadow-xl h-[8em] rounded-full h-auto align-middle border-none max-w-150-px">
          
              </div>
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
              <div class="py-6 px-3 mt-32 sm:mt-0">
                {{-- <button class="bg-pink-500 active:bg-pink-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150" type="button">
                  Connect
                </button> --}}
              </div>
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-1">
              <div class="flex justify-center py-4  lg:pt-4 pt-8">
                <div class="mr-4 p-3 text-center">
                  <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">22</span><span class="text-sm text-blueGray-400">Posts</span>
                </div>
                <div class="mr-4 p-3 text-center">
                  <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">10</span><span class="text-sm text-blueGray-400">Likes</span>
                </div>
                <div class="lg:mr-4 p-3 text-center">
                  <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">89</span><span class="text-sm text-blueGray-400">Comments</span>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-12">
            <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
              {{ $user->name }}
            </h3>
            <div class="text-sm font-bold text-green-700">Active User</div>
            <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
              <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i>
               {{ $userProfile->jobDescription}}
            </div>
            <div class="mb-2 text-blueGray-600 mt-10">
            </div>
            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-md font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{$userProfile->location}}</span>
            <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-md font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">{{$userProfile->level}}</span>

            <div class="flex justify-center p-4">
              @php
              $badgeStyles = [
                  'bg-gray-50 text-gray-600 ring-gray-500/10',
                  'bg-blue-50 text-blue-700 ring-blue-700/10',
                  'bg-indigo-50 text-indigo-700 ring-indigo-700/10',
                  'bg-purple-50 text-purple-700 ring-purple-700/10'
              ];
              @endphp
  
  
  
              @foreach ($user->categories as $index => $category)
              @php
                  $style = $badgeStyles[$index % count($badgeStyles)];
              @endphp
              <span class="inline-flex items-center mx-3 rounded-md px-2 py-1 text-sm font-medium ring-1 ring-inset {{ $style }}">
                  {{ $category->title }}
              </span>
              @endforeach
            </div>
          </div>
          <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
            <div class="flex justify-center">
              <div class="w-full lg:w-9/12 px-4">
                <p class="mb-4 text-lg leading-relaxed text-blueGray-700 w-full line-clamp-3">
                 {{$userProfile->bio}}
                 {{$userProfile->bio}}
                 {{$userProfile->bio}}
                 {{$userProfile->bio}}
                 {{$userProfile->bio}}
               
                <a href="#pablo" class="font-normal text-pink-500">Show more</a>
              </div>
              
  
            </div>
          </div>

        

        </div>
      </div>
    </div>
    <footer class="relative bg-blueGray-200 pt-8 pb-6 mt-8">
  <div class="container mx-auto px-4">
    <div class="flex flex-wrap items-center md:justify-between justify-center">
      <div class="w-full md:w-6/12 px-4 mx-auto text-center">
       
      </div>
    </div>
  </div>
</footer>
  </section>
</main> 


