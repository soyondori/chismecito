<x-app-layout>
  <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
      @foreach ($chismes as $chisme)
        <button class="w-full mt-6 bg-white shadow-sm rounded-lg divide-y cursor-pointer" onclick="window.location='{{ route('chismes.show', ['id' => $chisme->id]) }}'">
          <div class="flex flex-col justify-start p-6 space-x-2">
            <h1 class="text-left">{{ $chisme->title }}</h1>
            <small class="text-left text-gray-600"> {{ __('written by ').$chisme->author->name.' '.__('on').' '.$chisme->created_at->format('j m y, g:i a') }}</small>
          </div>
        </button>
      @endforeach
    </div>
</x-app-layout>