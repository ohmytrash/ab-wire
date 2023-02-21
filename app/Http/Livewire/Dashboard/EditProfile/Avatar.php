<?php

namespace App\Http\Livewire\Dashboard\EditProfile;

use App\Helpers\AvatarHelper;
use App\Http\Livewire\LivewireAuthorizes;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class Avatar extends Component
{
    use WithFileUploads, LivewireAuthorizes;

    public $image;

    protected $rules = ['image' => 'required|image|max:4000'];

    public function updatedImage()
    {
        $user = $this->auth();

        $data = null;
        try {
            $data = $this->validate();
        } catch (ValidationException $e) {
            $this->dispatchBrowserEvent('validation-error');
            $this->validate();
        }

        $avatar = AvatarHelper::generate($data['image'], $user->avatar);
        $user->avatar = $avatar;
        $user->save();

        $tmp_name = $data['image']->getRealPath();
        if (file_exists($tmp_name)) {
            unlink($tmp_name);
        }

        session()->flash('success', 'Foto profil berhasil diperbarui.');
        $this->emit('profile-updated');
        $this->dispatchBrowserEvent('avatar-created');
    }

    public function render()
    {
        return view('livewire.dashboard.edit-profile.avatar', ['user' => $this->auth()]);
    }
}
