<x-dashboard-layout title="Daftar Pelajaran">
  <x-dashboard.lessons.index-wrap :tab="$tab">
    @foreach($lessons as $lesson)
      <x-dashboard.lessons.lesson-list :lesson="$lesson" />
    @endforeach
    {{ $lessons->links() }}
  </x-dashboard.lessons.index-wrap>
</x-dashboard-layout>
  