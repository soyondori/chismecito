<x-app-layout>
  <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
      @foreach ($chismes as $chisme)
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
          <div class="p-6 flex space-x-2">
            <h1>{{ $chisme->title }}</h1>
          </div>
        </div>
      @endforeach
    </div>
</x-app-layout>