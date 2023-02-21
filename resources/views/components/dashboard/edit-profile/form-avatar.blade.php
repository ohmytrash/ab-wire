@props(['avatar' => Auth::user()->avatar_url])

<form id="form-update-avatar" action="{{ route('dashboard.edit-profile.avatar') }}" method="POST"
  class="mb-3 rounded-lg border-b-4 border-primary-500 bg-white shadow" enctype="multipart/form-data">
  @csrf
  <div class="border-b px-3 py-5 md:px-5">
    <h3 class="text-xl font-semibold">Ubah avatar</h3>
  </div>

  <div class="px-3 py-5 md:px-5" x-data="{
      name: '',
      url: '',
      ready: false,
      get avatar() {
          return this.url || '{{ $avatar }}'
      },
      onchange(e) {
          const [file] = e.target.files
          if (file) {
              this.name = file.name
              this.url = URL.createObjectURL(file)
              this.ready = true
          } else {
              this.name = ''
              this.url = ''
              this.ready = false
          }
      }
  }">
    <div class="flex">
      <div id="dd" class="h-[100px] w-[100px] bg-cover bg-center" x-bind:style="'background-image: url(' + avatar + ')'">
      </div>
      <div class="flex flex-1 flex-col pl-3">
        <div class="relative flex flex-1">
          <div class="flex flex-1 border border-dashed bg-gray-50 p-3">
            <p class="m-auto text-sm leading-none" x-text="name || 'KLIK DISINI ATAU SERET GAMBAR KESINI'"></p>
          </div>
          <input type="file" aria-hidden="true" name="image" x-on:change="onchange"
            class="absolute z-10 block h-full w-full opacity-0" />
        </div>
      </div>
    </div>
    <div class="pl-[100px] pt-3">
      @error('image')
        <div class="pl-3">
          <p class="text-center text-sm text-red-900">{{ $message }}</p>
        </div>
      @enderror
      <div class="pl-3 text-center" x-show="ready">
        <x-button>Upload</x-button>
      </div>
    </div>
  </div>
</form>
