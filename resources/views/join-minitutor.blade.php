<x-app-layout title="Jadi MiniTutor">
  <div class="p-3">
    <div class="mb-3 overflow-hidden rounded bg-cover shadow" style="background-image: url({{ asset('img/background/hero.jpg') }})">
      <div class="bg-opacity-30 bg-gradient-to-r from-primary-700 to-transparent p-4">
        <div class="flex flex-col items-center justify-center py-16 text-center">
          <h1 class="mb-3 text-2xl font-bold text-white md:text-3xl lg:text-4xl">
            Belajar, Berbagi, Berkontribusi.
          </h1>
          <p class="max-w-lg text-gray-100 md:text-lg">
            Pengembangan kemampuan diri dan kualitas pendidikan Indonesia,
            dimulai dari sini!
          </p>
        </div>
      </div>
    </div>
    <div class="rounded bg-white shadow">
      @if ($data)
        <div class="border-b py-5 px-3 text-center">
          <h1 class="mb-2 text-2xl font-semibold">
            Permintaan anda untuk menjadi minitutor sedang di tinjau.
          </h1>
          <p class="mb-3 text-sm text-gray-500">
            Nama, Alamat Email dan Foto secara otomatis ikut dalam formulir Anda
            sesuai dengan profil akun Anda.
          </p>
        </div>

        <form class="p-5" action="{{ route('join-minitutor') }}" method="POST">
          @csrf
          @method('PUT')
          <x-input-wrap label="Jenjang pendidikan terakhir">
            <x-input name="last_education_level" type="select">
              @foreach (App\Models\Minitutor::EDUCATION_LEVELS as $el)
                <option value="{{ $el }}" @if ($data->last_education_level == $el) selected @endif>{{ $el }}</option>
              @endforeach
            </x-input>
          </x-input-wrap>
          <hr class="mb-2 hidden md:block" />
          <x-input-wrap label="Kampus pendidikan terakhir">
            <x-input name="last_education_campus" :value="$data->last_education_campus" placeholder="Universitas DIPA Makassar" />
          </x-input-wrap>
          <hr class="mb-2 hidden md:block" />
          <x-input-wrap label="Jurusan pendidikan terakhir">
            <x-input name="last_education_majors" :value="$data->last_education_majors" placeholder="Teknik Informatika" />
          </x-input-wrap>
          <hr class="mb-2 hidden md:block" />
          <x-input-wrap label="Lokasi pendidikan terakhir">
            <x-input name="last_education_location" :value="$data->last_education_location" placeholder="Makassar, Indonesia" />
          </x-input-wrap>
          <hr class="mb-2 hidden md:block" />
          <x-input-wrap label="Alasan">
            <x-input name="reason" :value="$data->reason" type="textarea" help="Alasan mengapa anda ingin menjadi MiniTutor?" />
          </x-input-wrap>

          <div class="block border-t py-5 md:grid md:grid-cols-3 md:gap-3">
            <div></div>
            <div>
              <x-button class="w-24" value="Simpan" />
            </div>
          </div>
        </form>
      @else
        <div class="border-b py-5 px-3 text-center">
          <h1 class="mb-2 text-2xl font-semibold">
            Input Sesuai Data Diri Anda.
          </h1>
          <p class="mb-3 text-sm text-gray-500">
            Nama, Alamat Email dan Foto secara otomatis ikut dalam formulir Anda
            sesuai dengan profil akun Anda.
          </p>
        </div>
        <form class="p-5" action="{{ route('join-minitutor') }}" method="POST">
          @csrf
          <x-input-wrap label="Jenjang pendidikan terakhir">
            <x-input name="last_education_level" type="select">
              @foreach (App\Models\Minitutor::EDUCATION_LEVELS as $data)
                <option value="{{ $data }}" @if (old('last_education_level') == $data) selected @endif>{{ $data }}</option>
              @endforeach
            </x-input>
          </x-input-wrap>
          <hr class="mb-2 hidden md:block" />
          <x-input-wrap label="Kampus pendidikan terakhir">
            <x-input name="last_education_campus" placeholder="Universitas DIPA Makassar" />
          </x-input-wrap>
          <hr class="mb-2 hidden md:block" />
          <x-input-wrap label="Jurusan pendidikan terakhir">
            <x-input name="last_education_majors" placeholder="Teknik Informatika" />
          </x-input-wrap>
          <hr class="mb-2 hidden md:block" />
          <x-input-wrap label="Lokasi pendidikan terakhir">
            <x-input name="last_education_location" placeholder="Makassar, Indonesia" />
          </x-input-wrap>
          <hr class="mb-2 hidden md:block" />
          <x-input-wrap label="Alasan">
            <x-input name="reason" type="textarea" help="Alasan mengapa anda ingin menjadi MiniTutor?" />
          </x-input-wrap>

          <div class="block border-t py-5 md:grid md:grid-cols-3 md:gap-3">
            <div></div>
            <div>
              <x-button class="w-24" value="Kirim" />
            </div>
          </div>
        </form>
      @endif
    </div>
  </div>
</x-app-layout>
