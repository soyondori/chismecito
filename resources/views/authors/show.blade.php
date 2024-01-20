<x-app-layout>

  <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex flex-col">
      <h1>{{ $author->name }}</h1>
      <a class="underline" href="{{'mailto:'.$author->email}}">{{ $author->email }}</a>
      <span class="mt-1">{{__('Member since ').' '.$author->created_at->format('j/m/y, g:i a')}}</span>
    </div>

    <div class="flex flex-col mt-8">
      <div class="h-px bg-gray-300 w-full"></div>
      <div class="flex justify-between items-center mt-4">
        <h1>{{ __('Comments') }}</h1>

        <x-primary-button x-data="" class="h-10 w-24 justify-center ms-3" x-on:click.prevent="$dispatch('open-modal', 'comment-form')">
            {{ __('Add') }}
        </x-primary-button> 


        <x-modal name="comment-form" focusable>
          <form method="POST" action="{{ route('authors.comments.store') }}" class="p-6">
            @csrf
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Write a comment') }}
            </h2>
            <x-text-area-input class="mt-2 h-24 w-full" name="content" required></x-text-area-input>

            <input type="hidden" name="id" value="{{ $author->id }}">

            <div class="w-full flex justify-end mt-4">
              <x-primary-button type="submit" class="w-24 h-10 p-4 justify-center">
                  {{ __('Save') }}
              </x-primary-button>
            </div>
            
          </form>
        </x-modal>
      </div>

      @foreach ($comments as $comment)
        <div class="flex flex-col justify-start py-6 space-x-2">
          <span class="text-gray-500"> 
            <a class="underline hover:text-gray-900" href="{{ route('authors.show', ['id' => $comment->author_id]) }}">{{$comment->author->name}}</a> 
            {{__('commented on ').' '.$comment->created_at->format('j/m/y, g:i a') }}
          </span>
          <p class="text-left">{{ $comment->content }}</h1>
        </div>
      @endforeach

    </div>
  </div>
</x-app-layout>