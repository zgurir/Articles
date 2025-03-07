<x-default-layout>

    <!-- Topic Nav -->
    <nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
        <div class="block sm:hidden">
            <a
                href="#"
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
        </div>
    </nav>


    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">


        <x-post :$post />



            <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">
                <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">
                    <img src="https://source.unsplash.com/collection/1346951/150x150?sig=1" class="rounded-full shadow h-32 w-32">
                </div>
                <div class="flex-1 flex flex-col justify-center md:justify-start">
                    <p class="font-semibold text-2xl">{{$post->user->name}}</p>
                    <p class="pt-2">{{$post->user->infos}}</p>
                    <div class="flex items-center justify-center md:justify-start text-2xl no-underline text-blue-800 pt-4">
                        <a class="" href="#">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a class="pl-4" href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="pl-4" href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="pl-4" href="#">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
            @auth
        <form action="{{ route('posts.comment', ['post' => $post]) }}" method="POST" class="w-full">
            @csrf
            <div class="flex flex-col justify-center md:justify-start">
    <label class="mb-2 font-bold text-lg text-gray-900" for="comment">Laisser un commentaire :</label>
    <textarea rows="4" class="mb-4 px-3 py-2 border-2 border-gray-300 rounded-lg" id="comment" name="comment" placeholder="Quelque chose à rajouter ? 🎉" autocomplete="off"></textarea>
    <div class="flex justify-end">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded max-w-[100px]">Envoyer</button>
    </div>
</div>
@error('comment')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </form>
        @endauth
        @if($post->comments->count() > 0)
          <x-comment :$post />
        @endif


 <section class="w-full bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <div class="flex items-center gap-2">


     <div class="mt-2 flex items-center gap-2 sm:mt-0">
        <div class="flex items-center gap-0.5">
          @php $rate = (int) $post->note @endphp
          @for($i=1; $i<=$rate ; $i++)
          <svg class="h-4 w-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
          </svg>
          @endfor
          @for($j=$rate+1; $j<=5; $j++)
          <svg class="h-4 w-4 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
          </svg>
          @endfor

        </div>
        <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400"></p>
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">{{$post->ratings()->count()}} @if($post->ratings()->count()>1) Reviews @else Review @endif </h2>
      </div>
    </div>

    <div class="my-6 gap-8 sm:flex sm:items-start md:my-8">
      <div class="shrink-0 space-y-4">
        <p class="text-2xl font-semibold leading-none text-gray-900 dark:text-white">{{$post->note}} out of 5</p>
        <button id="openModalBtn" type="button" data-modal-target="review-modal" data-modal-toggle="review-modal" class="mb-2 me-2 rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Laisser une note</button>
      </div>

      <div class="mt-6 min-w-0 flex-1 space-y-3 sm:mt-0">
        <div class="flex items-center gap-2">
          <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">5</p>
          <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
          </svg>
          <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
            <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{$post->perc(5)['pourcentage']}}%""></div>
          </div>
          <div class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 dark:text-primary-500 sm:w-auto sm:text-left">{{$post->perc(5)['total']}} <span class="hidden sm:inline">@if($post->perc(5)['total']>1) reviews @else review @endif</span></div>
        </div>
        <div class="flex items-center gap-2">
          <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">4</p>
          <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
          </svg>
          <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
            <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{$post->perc(4)['pourcentage']}}%""></div>
          </div>
          <div class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 dark:text-primary-500 sm:w-auto sm:text-left">{{$post->perc(4)['total']}} <span class="hidden sm:inline">@if($post->perc(4)['total']>1) reviews @else review @endif</span></div>
        </div>

        <div class="flex items-center gap-2">
          <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">3</p>
          <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
          </svg>
          <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
            <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{$post->perc(3)['pourcentage']}}%"></div>
          </div>
          <div class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 dark:text-primary-500 sm:w-auto sm:text-left">{{$post->perc(3)['total']}} <span class="hidden sm:inline">@if($post->perc(3)['total']>1) reviews @else review @endif</span></div>
        </div>

        <div class="flex items-center gap-2">
          <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">2</p>
          <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
          </svg>
          <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
            <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{$post->perc(2)['pourcentage']}}%""></div>
          </div>
          <div class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 dark:text-primary-500 sm:w-auto sm:text-left">{{$post->perc(2)['total']}} <span class="hidden sm:inline">@if($post->perc(2)['total']>1) reviews @else review @endif</span></div>
        </div>

        <div class="flex items-center gap-2">
          <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">1</p>
          <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
          </svg>
          <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
            <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{$post->perc(1)['pourcentage']}}%""></div>
          </div>
          <div class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 dark:text-primary-500 sm:w-auto sm:text-left">{{$post->perc(1)['total']}}<span class="hidden sm:inline"> @if($post->perc(1)['total']>1) reviews @else review @endif</span></div>
        </div>

        <div class="flex items-center gap-2">
          <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">0</p>
          <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
          </svg>
          <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
            <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{$post->perc(0)['pourcentage']}}%""></div>
          </div>
          <div class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 dark:text-primary-500 sm:w-auto sm:text-left">{{$post->perc(0)['total']}}<span class="hidden sm:inline"> @if($post->perc(1)['total']>1) reviews @else review @endif</span></div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Add review modal -->
<div id="review-modal" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 antialiased">
  <div class="relative max-h-full w-full max-w-2xl p-4">
    <!-- Modal content -->
    <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
      <!-- Modal header -->
       <form action="{{ route('add-rating')}}" method="POST" class="p-4 md:p-5">
        @csrf
        <input type="hidden" name="post_id" value="{{$post->id}}">
      <div class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700 md:p-5">
        <button id="closeModalBtn" type="button" class="absolute right-5 top-5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="review-modal">
          <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->

        <div class="mb-4 grid grid-cols-2 gap-4">
          <div class="col-span-2">
            <div class="flex items-center">
            @if($user_rating)
            @for($i=1; $i<=$user_rating->stars_rated ; $i++)
            <svg class="star h-6 w-6 text-yellow-500 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />

              </svg>
          @endfor
          @for($j=$user_rating->stars_rated+1; $j<=5; $j++)
          <svg class="star h-6 w-6 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />

              </svg>
          @endfor
          <span id="rating-text" class="rating-text ms-2 text-lg font-bold text-gray-900 dark:text-white">{{$user_rating->stars_rated}} out of 5</span>
             @else
              <svg class="star h-6 w-6 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />

              </svg>
              <svg class="star ms-2 h-6 w-6 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
              </svg>
              <svg class="star ms-2 h-6 w-6 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
              </svg>
              <svg class="star ms-2 h-6 w-6 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
              </svg>
              <svg class="star ms-2 h-6 w-6 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
              </svg>
              <span id="rating-text" class="rating-text ms-2 text-lg font-bold text-gray-900 dark:text-white">0 out of 5</span>
              @endif

            </div>
          </div>


        </div>
        <div id="rating-error-message" style="display:none;"> Vous devez sélectionner une note avant de soumettre. </div>
        <div class="border-t border-gray-200 pt-4 dark:border-gray-700 md:pt-5">
          <button id="rating" name="rating" type="submit" class="rating me-2 inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Add review</button>
          <button id="closeModalBtn2" type="button" data-modal-toggle="review-modal" class="me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
        </section>
<script>
    // Récupérer les éléments du DOM
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const closeModalBtn2 = document.getElementById('closeModalBtn2');
    const modal = document.getElementById('review-modal');

    // Ouvrir le modal
    openModalBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    // Fermer le modal
    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
    closeModalBtn2.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Fermer le modal en cliquant en dehors de la boîte du modal
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script>
<script>
    const stars = document.querySelectorAll('.star');
    const ratingText = document.getElementById('rating-text');
    const ratingInput = document.getElementById('rating');
    const ratingErrorMessage = document.getElementById('rating-error-message');

    let rating = "<?php if($user_rating) echo $user_rating->stars_rated; else echo 0 ; ?>"; //Pour afficher les étoiles en jaunes lors de la màj d'un avis
    let starClicked = false;
    // Fonction pour mettre à jour la couleur des étoiles en fonction de la note
    function updateStars() {
        stars.forEach((star, index) => {
            star.classList.remove('text-yellow-500');
            star.classList.remove('text-gray-400'); // Assurez-vous de retirer aussi le gris
            if (index < rating) {
                star.classList.add('text-yellow-500');
            } else {
                star.classList.add('text-gray-400');  // Réafficher les étoiles en gris si la note est 0 ou inférieure à l'index
            }
        });
    }

    // Survol des étoiles
    stars.forEach((star, index) => {
        star.addEventListener('mouseover', () => {
            // Affiche la couleur dorée sur les étoiles au survol
            stars.forEach((s, i) => {
                s.classList.remove('text-yellow-500');
                if (i <= index) {
                    s.classList.add('text-yellow-500');
                }
            });
        });

        // Retour à la couleur grise après le survol
        star.addEventListener('mouseout', () => {
            updateStars();  // Revenir à la couleur actuelle
        });

        ratingInput.addEventListener('click', () => {
            if(!starClicked){ //si aucune étoile n'a été cliquée
                ratingErrorMessage.style.display ='block';
                event.preventDefault(); //Empecher l'action par défaut (rechargement de la page) du boutton 'rating'
            }
        });
        // Clic sur une étoile pour sélectionner la note
        star.addEventListener('click', () => {
            if (index === 0 && rating !== 0) {
                // Si la première étoile est cliquée et que la note n'est pas déjà 0, réinitialiser la note
                rating = 0;
            } else {
                // Sinon, définir la note en fonction de l'étoile cliquée
                rating = index + 1;
            }

            ratingInput.value = rating; // Mettre à jour la valeur cachée dans le formulaire
            ratingText.innerText = rating === 0 ? `0 out of 5` : `${rating} out of 5`;
            starClicked =true;
            updateStars();  // Mettre à jour la couleur des étoiles
        });
    });

    // Initialisation : Mettre à jour l'affichage en fonction de la note initiale (0 au début)
    updateStars();

</script>


        <!-- Sidebar Section -->
        <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">About us</p>
                <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
                <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                    Get to know us
                </a>
            </div>

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">Instagram</p>
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

</x-default-layout>
