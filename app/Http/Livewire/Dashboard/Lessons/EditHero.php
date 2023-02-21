<?php

namespace App\Http\Livewire\Dashboard\Lessons;

use App\Helpers\HeroHelper;
use App\Http\Livewire\LivewireAuthorizes;
use App\Models\Lesson;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditHero extends Component
{
    use WithFileUploads, LivewireAuthorizes;

    public Lesson $lesson;

    public $image;

    protected $rules = ['image' => 'required|image|max:4000'];


    public function updatedImage()
    {
        $minitutor = $this->activeMinitutor();
        abort_unless($this->lesson->minitutor_id === $minitutor->id, 403);

        $data = null;
        try {
            $data = $this->validate();
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('hero-error');
            $this->validate();
        }

        $name = HeroHelper::generate($data['image'], $this->lesson->hero);

        $tmp_name = $data['image']->getRealPath();
        if (file_exists($tmp_name)) {
            unlink($tmp_name);
        }

        $this->lesson->hero = $name;
        $this->lesson->save();

        session()->flash('message', 'Gambar pelajaran berhasil diperbarui');
        $this->dispatchBrowserEvent('hero-created');
    }

    public function render()
    {
        return view('livewire.dashboard.lessons.edit-hero');
    }
}
