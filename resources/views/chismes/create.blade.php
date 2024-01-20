<x-app-layout>
  <div class="max-w-3xl h-80 mx-auto p-4 sm:p-6 lg:p-8">
    <form method="POST" action="{{ route('chismes.store') }}">
      @csrf
      <x-input-label for="title" :value="__('Title')" />
      <x-text-input class="w-full mt-1 mb-8" name="title" required autofocus />

      <x-text-input id="chisme-form" type="hidden" name="content" />
      <trix-editor class="mt-4" input="chisme-form"></trix-editor>

      <x-primary-button type="submit" class="w-full mt-4 p-4 justify-center h-12">
          {{ __('Save') }}
      </x-primary-button>
    </form>
  </div>
</x-app-layout>