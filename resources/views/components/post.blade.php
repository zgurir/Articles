@props(['post', 'list' => false])

<article @class(['grid grid-rows-[100px, 100px] gap-4 shadow my-4', 'border-2 border-black border-solid' => $list,])>
    <p class="pt-0 relative justify-self-center text-3xl font-bold hover:text-gray-700"> {{$post->title}}
    <span class="pb-0 absolute top-full left-0 text-blue-700 text-sm font-bold Lowercase"> {{$post->view_count}} view </span>
    </p>
    <div class="mt-4 justify-self-center flex-col justify-items-center">
      <img class="hover:opacity-75" src="{{ str_starts_with($post->thumbnail, 'http') ? $post->thumbnail : asset('storage/' . $post->thumbnail) }}" alt="image de l'article">
      <p class="text-sm pb-0">
        By <a href="#" class="font-semibold hover:text-gray-800">David Grzyb</a>, Published on {{$post->created_at}}
      </p>
      <div>
                @if($post->category)
                    <a href="{{ route('posts.byCategory', ['category' => $post->category]) }}" class="text-blue-700 text-sm font-bold uppercase pb-4"> {{$post->category->name}} </a>
                @else
                <span class="text-blue-700 text-sm font-bold uppercase pb-4"> No Cat </span>
                @endif
                @if($post->tags->isNotEmpty())
                @foreach($post->tags as $tag)
                <a href="{{ route('posts.byTag', ['tag' => $tag]) }}" class="text-blue-700 text-sm font-bold uppercase pb-4"> #{{$tag->name}} </a>
                @endforeach
                @else
                <span class="text-blue-700 text-sm font-bold uppercase pb-4"> No Tag </span>
                @endif
       </div>
    </div>


                    @if($list)
                    <a href="#" class="mt-0 mb-0"> {{$post->excerpt}} </a>
                    <a href="{{ route('posts.show', ['post'=>$post]) }}" class="mt-0 uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
                    @else
                    <p class="mt-4 pb-3 pl-2"> {!! nl2br(e($post->content)) !!} </p>
                    <div class="w-full flex pt-6">
                      <!-- $post->id > 1  && -->  @if($post->find($post->id-1))
                <a href="{{ route('posts.show', ['post'=>App\Models\Post::find($post->id-1)]) }}" class="w-1/2 bg-white shadow hover:shadow-md text-left p-6">
                    <p class="text-lg text-blue-800 font-bold flex items-center"><i class="fas fa-arrow-left pr-1"></i> Previous</p>
                    <p class="pt-2">{{\App\Models\Post::find($post->id-1)->slug}}</p>
                </a>
                @endif
                <!-- $post->id < \App\Models\Post::count() && --> @if ($post->find($post->id+1))
                <a href="{{ route('posts.show', ['post'=>App\Models\Post::find($post->id+1)]) }}" class="w-1/2 bg-white shadow hover:shadow-md text-right p-6">
                    <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <i class="fas fa-arrow-right pl-1"></i></p>
                    <p class="pt-2">{{\App\Models\Post::find($post->id+1)->slug}}</p>
                </a>
                @endif
            </div>
                    @endif
            </article>
