<x-app-layout>

  <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex flex-col">
      <h1>{{ $chisme->title }}</h1>
      <div class="flex justify-start items-center mt-1">
        <span class="text-gray-500"> {{ __('Written by ').$chisme->author->name.' '.__('on').' '.$chisme->created_at->format('j/m/y, g:i a') }}</span>
      </div>
    </div>

    <div class="chisme-content mt-8">
      {!! $chisme->content !!}
    </div>

    <div class="flex flex-col mt-8">
      <div class="h-px bg-gray-300 w-full"></div>
      <div class="flex justify-between items-center mt-4">
        <h1>{{ __('Comments') }}</h1>

        <x-primary-button x-data="" class="h-10 w-24 justify-center ms-3" x-on:click.prevent="$dispatch('open-modal', 'comment-form')">
            {{ __('Add') }}
        </x-primary-button> 


        <x-modal name="comment-form" focusable>
          <form method="POST" action="{{ route('chismes.comments.store') }}" class="p-6">
            @csrf
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Write a comment') }}
            </h2>
            <x-text-area-input class="mt-2 h-24 w-full" name="content" required></x-text-area-input>

            <input type="hidden" name="id" value="{{ $chisme->id }}">

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
            <a>{{ $chisme->author->name}}</a> {{__('commented on ').' '.$chisme->created_at->format('j/m/y, g:i a') }}
          </span>
          <p class="text-left">{{ $comment->content }}</h1>
        </div>
      @endforeach

    </div>
  </div>
</x-app-layout>