<x-app-layout>
    @section('hero')
    <div class="bg-gradient-to-r from-teal-600 via-teal-300 to-white w-full text-center py-28">
            <img src="{{ asset('images/lumina1.png') }}" alt="lumina1" class="w-25 h-auto mx-auto"  >
        <p class="text-gray-500 text-lg mt-1 font-semibold">WELCOME TO APIIT STUDENT BLOG</p>
        <a class="px-3 py-2 text-lg text-white bg-gray-900 rounded mt-5 inline-block"
            href="/blog">Start
            Reading</a>
    </div>
    @endsection

    <div class="mb-10 w-full">

        <div class="about">
            <section class="bg-white">
                <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                    <div class="font-light text-gray-500 sm:text-lg">
                        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Sharing Your Story</h2>
                        <p class="mb-4">This blog is for you, the students of APIIT. It's a platform to share your experiences, stories, and insights about student life at our university.</p>
                        <p>Here, you'll find tips and advice on navigating academics, information about upcoming events and activities, campus life, and beyond, as well as personal stories from your fellow students. We hope this blog will help you feel more connected to the APIIT community and provide you with the resources you need to succeed.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <img class="w-full rounded-lg" src="{{ asset('images/about2.jpg') }}" alt="APIIT building">
                        <img class="mt-4 w-full lg:mt-10 rounded-lg" src="{{ asset('images/about3.jpg') }}" alt="APIIT students">
                    </div>
                </div>
            </section>
        </div>
        
        <hr>
        
        <div class="mb-16 px-4 md:px-0">
            <h2 class="mt-16 mb-5 text-3xl text-gray-900 font-bold text-center">Featured Posts</h2> <br><br>
            <div class="w-full">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach ($featuredPosts as $post )
                            <x-posts.post-card :post="$post"  class="md:col-span-1 col-span-3"/>  
                    @endforeach
                </div>
            </div>
            <a class="mt-10 block text-center text-lg text-gray-900 font-semibold"
                href="/blog">More
                Posts ></a>
        </div>
        <hr>

        <!---<div x-data="{
            show: false,
            value : null
        }">
            <button x-on:click="show = !show">
                Show
            </button>

            <select name="" id="" x-model="value">
                <option value="1">1</option>
                <option value="2">2</option>
            </select>

            <div x-show="value == 1">
                More content
            </div>
        </div>-->

        <div class="mb-16 px-4 md:px-0">
            <h2 class="mt-16 mb-5 text-3xl text-gray-900 font-bold text-center">Latest Posts</h2>
            <div class="w-full mb-5">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach ($latestPosts as $post )
                            <x-posts.post-card :post="$post"  class="md:col-span-1 col-span-3"/>                     
                    @endforeach
                </div>
            </div>
            <a class="mt-10 block text-center text-lg text-gray-900 font-semibold"
                href="/blog">
                More
                Posts >
            </a>
        </div>

    </div>
</x-app-layout>
