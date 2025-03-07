<x-default-layout>

    <!-- Topic Nav -->
    <nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
        <div class="block sm:hidden">
            <a
                href=""
                class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
                @click="open = !open"
            >
                Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
            </a>
        </div>
        <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
            <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
                @foreach($categorys as $category)
                <a href="{{ route('posts.byCategory', ['category' => $category]) }}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">{{$category->name}}</a>
                @endforeach
            </div>
            <form action="{{ route('posts.index') }}" class="flex items-center max-w-sm mx-auto">
    <label for="simple-search" class="sr-only">Search</label>
    <div class="relative w-full space-x-8">
        <div class="absolute inset-y-0 start-0 flex items-center ps-7 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
            </svg>
        </div>
    <div>
        <input name="search" value ="{{request()->search}}" type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search branch name..." />
    </div></div>
    <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
        <span class="sr-only">Search</span>
    </button>
</form>
        </div>
    </nav>


    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">
        @forelse ($posts as $post)
      <x-post :$post list />
        @empty
        <p class="text-slate-400 text-center"> Aucun résultat. </p>
        @endforelse
            <!-- Pagination -->
            <div class="flex items-center py-8">


                {{$posts->links()}}

        </section>

        <!-- Sidebar Section -->
        <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">About Us</p>
                <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
                <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                    Get to know us
                </a>
            </div>

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">@auth Instagram {{ Auth::user()->name }} @endauth</p>
                <div class="grid grid-cols-3 gap-3">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=1">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=2">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=3">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=4">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=5">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=6">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=7">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=8">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=9">
                </div>
                <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-6">
                    <i class="fab fa-instagram mr-2"></i> Follow @dgrzyb
                </a>
            </div>

        </aside>

    </div>

    <footer class="w-full border-t bg-white pb-12">

    <div class="-mb-12"> <!--Pour l'alignement des deux bouttons au meme niveau verticalement -->
    @if (!$posts->onFirstPage())
        <a href="{{ $posts->previousPageUrl() }}" class="relative w-full flex items-center invisible md:visible md:pb-12" >
            <button class="absolute bg-blue-800 hover:bg-blue-700 text-white text-2xl font-bold hover:shadow rounded-full w-16 h-16 ml-12" >
                &#8592;
            </button>

                 </a></div>
                 @endif
                 @if ($posts->hasMorePages())
                 <a href="{{ $posts->nextPageUrl() }}" class="relative w-full flex items-center invisible md:visible md:pb-12">
            <button class="absolute right-0 bg-blue-800 hover:bg-blue-700 text-white text-2xl font-bold hover:shadow rounded-full w-16 h-16 mr-12">
                &#8594;
            </button>
             </a>
             @endif

</x-default-layout>
