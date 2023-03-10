@props(['lesson', 'tab' => request()->input('tab')])

<div class="container p-3">
  <div class="overflow-hidden rounded bg-white shadow">
    <div class="grid grid-cols-4 border-b p-3 md:gap-3">
      <a href="{{ route('dashboard.lessons.edit', $lesson->id) }}"
        class="@if ($tab === 'info') bg-primary-600 text-white @else hover:bg-gray-100 @endif block rounded p-3 text-center text-sm font-semibold leading-none md:text-base">Informasi</a>
      <a href="{{ route('dashboard.lessons.edit', ['lesson' => $lesson->id, 'tab' => 'hero']) }}"
        class="@if ($tab === 'hero') bg-primary-600 text-white @else hover:bg-gray-100 @endif block rounded p-3 text-center text-sm font-semibold leading-none md:text-base">Gambar</a>
      <a href="{{ route('dashboard.lessons.edit', ['lesson' => $lesson->id, 'tab' => 'episodes']) }}"
        class="@if ($tab === 'episodes') bg-primary-600 text-white @else hover:bg-gray-100 @endif block rounded p-3 text-center text-sm font-semibold leading-none md:text-base">Episode</a>
        <form
          x-data="{
            loading: false,
            onclick(e) {
              e.preventDefault()
              this.loading = true
              this.$store.deleteConfirm(() => {
                this.$refs.formDeleteLesson.requestSubmit()
              }, () => {
                this.loading = false
              }, {
                text: 'Kamu akan menghapus pelajaran ini secara permanen!',
              })
            }
          }"
          x-ref="formDeleteLesson"
          method="POST"
          action="{{route('dashboard.lessons.destroy', $lesson->id)}}"
        >
          @csrf
          @method('DELETE')
          <x-button type="button" @click="onclick" x-bind:disabled="loading" variant="red" class="!block w-full h-full !bg-red-100 !text-red-900 hover:!bg-red-600 disabled:!bg-red-600 hover:!text-white !border-0 disabled:!text-transparent">Hapus</x-button>
        </form>
        {{-- <a href="{{ route('dashboard.lessons.edit', ['lesson' => $lesson->id, 'tab' => 'reviews']) }}"
        class="block rounded p-3 text-center text-sm font-semibold leading-none md:text-base bg-red-100 text-red-900 hover:bg-red-600 hover:text-white">Hapus</a> --}}
    </div>
    <div class="rounded-bottom bg-white border-b-4 border-primary-600">
      {{ $slot }}
    </div>
  </div>
</div>
