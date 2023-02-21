@props(['lesson', 'categories'])

<form method="POST" action="{{ route('dashboard.lessons.update.info', $lesson->id) }}" class="mb-3 rounded bg-white shadow">
  @csrf
  <div class="px-3 py-5">
    <h3 class="text-lg font-semibold">Informasi</h3>
  </div>
  <div class="border-y p-3">
    <x-input-wrap label="Judul" :grid="false">
      <x-input name="title" placeholder="Judul" />
    </x-input-wrap>
    <x-input-wrap label="Kategori" :grid="false">
      <x-input name="category" type="select">
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" @if ($lesson->category_id == $category->id) selected @endif>{{ $category->name }}</option>
        @endforeach
      </x-input>
    </x-input-wrap>
    <x-input-wrap label="Deskripsi" :grid="false">
      <x-input name="category" placeholder="Deskripsi" type="textarea" />
    </x-input-wrap>
  </div>
  <div class="p-3">
    <x-button value="Simpan" />
  </div>
</form>
