<form id="form-update-password" action="{{ route('dashboard.edit-profile.password') }}" method="POST"
  class="mb-3 rounded-lg border-b-4 border-primary-500 bg-white shadow">
  @csrf
  @method('PUT')
  <div class="border-b px-3 py-5 md:px-5">
    <h3 class="text-xl font-semibold">Ubah password</h3>
  </div>

  <div class="px-3 py-5 md:px-5">
    <x-input-wrap label="Password baru">
      <x-input name="new_password" type="password" placeholder="Password baru" />
    </x-input-wrap>
    <hr class="mb-2 hidden md:block" />
    <x-input-wrap label="Password lama">
      <x-input name="old_password" type="password" placeholder="Password lama" />
    </x-input-wrap>
  </div>

  <div class="block border-t py-5 px-3 md:grid md:grid-cols-3 md:gap-3 md:px-5">
    <div></div>
    <div>
      <x-button class="w-24" value="Simpan" />
    </div>
  </div>
</form>
