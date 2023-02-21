@props([
    'minitutor' => Auth::user()->minitutor,
])

<form action="{{ route('dashboard.edit-profile.minitutor') }}" method="POST"
  class="mb-3 rounded-lg border-b-4 border-primary-500 bg-white shadow">
  @csrf
  @method('PUT')
  <div class="border-b px-3 py-5 md:px-5">
    <h3 class="text-xl font-semibold">Informasi MiniTutor</h3>
  </div>

  <div class="px-3 py-5 md:px-5">
    <x-input-wrap label="Jenjang pendidikan terakhir">
      <x-input name="last_education_level" type="select">
        @foreach (App\Models\Minitutor::EDUCATION_LEVELS as $el)
          <option value="{{ $el }}" @if ($minitutor->last_education_level == $el) selected @endif>{{ $el }}</option>
        @endforeach
      </x-input>
    </x-input-wrap>
    <hr class="mb-2 hidden md:block" />
    <x-input-wrap label="Kampus pendidikan terakhir">
      <x-input name="last_education_campus" :value="old('last_education_campus') ?? $minitutor->last_education_campus" placeholder="Universitas DIPA Makassar" />
    </x-input-wrap>
    <hr class="mb-2 hidden md:block" />
    <x-input-wrap label="Jurusan pendidikan terakhir">
      <x-input name="last_education_majors" :value="old('last_education_majors') ?? $minitutor->last_education_majors" placeholder="Teknik Informatika" />
    </x-input-wrap>
    <hr class="mb-2 hidden md:block" />
    <x-input-wrap label="Lokasi pendidikan terakhir">
      <x-input name="last_education_location" :value="old('last_education_location') ?? $minitutor->last_education_location" placeholder="Makassar, Indonesia" />
    </x-input-wrap>
  </div>

  <div class="block border-t py-5 px-3 md:grid md:grid-cols-3 md:gap-3 md:px-5">
    <div></div>
    <div>
      <x-button class="w-24" value="Simpan" />
    </div>
  </div>
</form>
