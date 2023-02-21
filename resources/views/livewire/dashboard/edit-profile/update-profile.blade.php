<form wire:submit.prevent="submit" class="mb-3 rounded-lg border-b-4 border-primary-500 bg-white shadow">
  <div class="border-b px-3 py-5 md:px-5">
    <h3 class="text-xl font-semibold">Informasi akun</h3>
  </div>
  <div class="px-3 py-5 md:px-5">
    <x-input-wrap label="Nama">
      <x-input model="name" placeholder="Nama kamu" />
    </x-input-wrap>
    <hr class="mb-2 hidden md:block" />
    <x-input-wrap label="Username">
      <x-input model="username" placeholder="Username" />
      <hr class="mb-2 hidden md:block" />
    </x-input-wrap>
    <hr class="mb-2 hidden md:block" />
    <x-input-wrap label="URL Website">
      <x-input model="website" placeholder="URL Website" />
    </x-input-wrap>
    <hr class="mb-2 hidden md:block" />
    <x-input-wrap label="Bio">
      <x-input model="bio" type="textarea" />
    </x-input-wrap>
    <hr class="mb-2 hidden md:block" />
    <x-input-wrap label="Notifikasi Email">
      <x-input model="email_notification" type="select">
        <option value="true">YA</option>
        <option value="false">TIDAK</option>
      </x-input>
    </x-input-wrap>
  </div>
  <div class="block border-t py-5 px-3 md:grid md:grid-cols-3 md:gap-3 md:px-5">
    <div></div>
    <div>
      <x-button class="w-24" value="Simpan" />
    </div>
  </div>
</form>
