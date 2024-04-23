<x-app-layout>
    <x-slot name="title">
        {{ __('Add Post') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your posts adhere to the policies of APIIT') }}
    </x-slot>

    <div class="container mt-5 md:mt-5 md:col-span-2">
        <h1>Add Post</h1>
        <section class="mt-3">
            <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                <div class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="card p-3">
                            <label for="floatingInput">Title</label>
                            <input class="form-control mb-4" type="text" name="title">
                            <label for="floatingInput">Subtitle</label>
                            <input class="form-control mb-4" type="text" name="subtitle">
                            <label for="floatingInput">Slug</label>
                            <input class="form-control mb-4" type="text" name="slug">
                            <label for="floatingTextArea">Description</label>
                            <textarea class="form-control mb-4" name="body" id="floatingTextarea" cols="30" rows="10"></textarea>
                            <label for="formFile" class="form-label">Add Image</label>
                            <img src="" alt="" class="img-blog">
                            <input class="form-control mb-5" type="file" name="image">
                            <x-button>
                                {{ __('Submit') }}
                            </x-button>

                            @csrf
                            <!-- Error message when data is not inputted -->
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>



                    </div>

                </div>



            </form>
        </section>

    </div>

</x-app-layout>