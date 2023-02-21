<form
    x-data
    wire:submit.prevent="submit"
    class="mb-3 rounded border-b-4 border-primary-600 bg-white shadow"
>
    <x-alert />
    <div class="border-b px-3 py-5">
        <h3 class="text-xl font-semibold">Informasi akun</h3>
    </div>
    <div class="px-3 py-5">
        <x-input-wrap label="Nama">
            <x-input model="name" placeholder="Nama kamu" />
        </x-input-wrap>
        <x-input-wrap label="Username">
            <x-input model="username" placeholder="Username" />
        </x-input-wrap>
        <x-input-wrap label="URL Website">
            <x-input model="website" placeholder="URL Website" />
        </x-input-wrap>
        <x-input-wrap label="Bio">
            <x-input model="bio" type="textarea" />
        </x-input-wrap>
        <x-input-wrap label="Notifikasi Email">
            <x-input model="email_notification" type="select">
                <option value="true">YA</option>
                <option value="false">TIDAK</option>
            </x-input>
        </x-input-wrap>
    </div>
    <div class="border-t p-3">
        <x-button class="w-24" value="Simpan" />
    </div>
</form>
  