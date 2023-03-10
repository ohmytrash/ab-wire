@props([
    'head' => '',
    'script' => '',
    'title' => config('app.name', 'Laravel'),
    'description' => config('app.description', 'The Laravel Framework.'),
])

<x-root-layout>
  <x-slot:head>
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}" />
    {!! $head !!}
    @livewireStyles
  </x-slot:head>
  <x-slot:script>
    @livewireScripts
    {!! $script !!}
  </x-slot:script>

  <x-layouts.navbar />

  <div class="flex">
    <x-layouts.sidebar-wrap>
      <x-layouts.sidebar-link route="dashboard.activities" is="dashboard.activities" text="Aktifitas" icon="activity" />
      <x-layouts.sidebar-link route="dashboard.edit-profile" is="dashboard.edit-profile" text="Edit Profil" icon="settings" />
      @if (Auth::user()->minitutor?->active)
        <span class="block py-3"></span>
        <x-layouts.sidebar-link route="dashboard.lessons.index" is="dashboard.lessons*" text="Pelajaran" icon="book-open" />
      @endif
    </x-layouts.sidebar-wrap>
    <div class="relative flex min-h-screen max-w-full flex-1 flex-col pl-0 lg:pl-60">
      <div class="w-full flex-1 pt-16">
        {{ $slot }}
      </div>
      <x-layouts.footer />
    </div>
  </div>
</x-root-layout>
