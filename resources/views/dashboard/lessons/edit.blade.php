<x-dashboard-layout title="Edit Pelajaran">
  <x-dashboard.lessons.edit-wrap :lesson="$lesson" :tab="$tab">
    @if ($tab === 'info')
      <livewire:dashboard.lessons.edit-information :lesson="$lesson" />
    @elseif($tab === 'hero')
      <livewire:dashboard.lessons.edit-hero :lesson="$lesson" />
    @elseif($tab === 'episodes')
      <livewire:dashboard.lessons.show-episodes :lesson="$lesson" />
    @elseif($tab === 'reviews')
      <livewire:dashboard.lessons.show-reviews :lesson="$lesson" />
    @endif
  </x-dashboard.lessons.edit-wrap>
</x-dashboard-layout>
