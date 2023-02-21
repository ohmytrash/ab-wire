<x-dashboard-layout title="Edit Profile">
  <div class="container p-3">
    <livewire:dashboard.edit-profile.account />
    <livewire:dashboard.edit-profile.avatar />
    {{-- <x-dashboard.edit-profile.form-account /> --}}
    {{-- <x-dashboard.edit-profile.form-avatar /> --}}
    <x-dashboard.edit-profile.form-password />
    @if (auth()->user()->minitutor?->active)
      <x-dashboard.edit-profile.form-minitutor />
    @endif
  </div>
</x-dashboard-layout>
