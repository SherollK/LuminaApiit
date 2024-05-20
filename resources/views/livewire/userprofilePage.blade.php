
<main class="profile-page" >

    <!--container  px-4 /  relative flex flex-col min-w-0 break-words bg-white  mb-6 shadow-xl  -mt-64 / px-6 /  rounded-lg w-full -->
  <div class=" py-3 bg-blueGray-200">
          <div class="justify-center mx-auto">

              <div class="flex justify-center relative mt-6">
                <img alt="" src="{{$user->profile_photo_url}}" class="shadow-xl h-[12em] rounded-full h-auto align-middle border-none max-w-150-px">

              </div>

                <div class="flex justify-center py-4  lg:pt-4 pt-8">
                    <div class="w-20 p-3 text-center">
                        <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">22</span><span class="text-sm text-blueGray-400">Posts</span>
                    </div>
                    <div class="w-20 p-3 text-center">
                        <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">89</span><span class="text-sm text-blueGray-400">Comments</span>
                    </div>
                    <div class="w-20 p-3 text-center">
                        <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">10</span><span class="text-sm text-blueGray-400">Likes</span>
                    </div>
                </div>


          </div>

          <div class="text-center mt-5">
            <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
              {{ $user->name }}
            </h3>
            <div class="text-sm font-bold text-green-700">Active User</div>
            <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i>
               {{ $userProfile->jobDescription}}

              <div class="p-3 mt-5">
                  <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-md font-medium mr-3 text-green-700 ring-1 ring-inset ring-green-600/20">{{$userProfile->location}}</span>
                  <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-md font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">{{$userProfile->level}}</span>
              </div>
                </div>
          </div>


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

            <div class="flex justify-center text-center">
              <div class="w-full lg:w-9/12 px-4">
                <p class="mb-4 text-lg leading-relaxed text-blueGray-700 w-full line-clamp-3">
                 {{$userProfile->bio}}
              </div>
            </div>

    <footer class="relative bg-blueGray-200 pt-8 pb-6 mt-8">
        <div class="container mx-auto px-4"></div>
   </footer>
</main>


