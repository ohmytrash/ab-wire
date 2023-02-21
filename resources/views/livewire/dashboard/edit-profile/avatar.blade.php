<div
  x-data="{
    name: '',
    uploading: false,
    progress: 0,
    get message() {
      return (this.progress < 100) ? `SEDANG DIUNGGAH: ${this.progress}%` : 'GAMBAR SEDANG DIPROSES'
    },
    onchange(e) {
      const [file] = e.target.files
      this.name = file ? file.name : ''
    },
    onComplete() {
      this.name = ''
      this.uploading = false
      this.progress = 0
    }
  }"
  x-on:livewire-upload-start="uploading = true"
  x-on:livewire-upload-progress="progress = $event.detail.progress"
  x-on:livewire-upload-error="onComplete"
  x-on:validation-error="onComplete"
  x-on:avatar-created="onComplete"
  class="mb-3 rounded border-b-4 border-primary-600 bg-white shadow"
>
    <x-alert />
    <div class="border-b px-3 py-5">
        <h3 class="text-xl font-semibold">Foto profil</h3>
    </div>
    <div class="p-3">
        <div class="flex">
            <div id="dd" class="bg-cover bg-center" x-bind:style="`background-image: url('{{ $user->avatar_url }}')`">
                <img src="{{ $user->avatar_url }}" class="invisible block opacity-0" aria-hidden="true" />
            </div>
            <div class="flex min-h-[100px] flex-1 flex-col pl-3">
                <div class="relative flex flex-1 flex-col border border-dashed bg-gray-50 p-3">
                <p class="m-auto text-center text-sm leading-none" x-text="name || 'KLIK DISINI ATAU SERET GAMBAR KESINI'"></p>
                <p class="text-center text-sm" x-show="uploading" x-text="message"></p>
                <input x-bind:disabled="uploading" type="file" aria-hidden="true" wire:model="image" accept="image/*" x-on:change="onchange" class="absolute z-10 block h-full w-full opacity-0" />
                </div>
            </div>
        </div>
    </div>
</div>
