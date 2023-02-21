<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use App\Rules\Username;
use Livewire\Component;

class EditProfile extends Component
{
    public User $user;

    public $name;
    public $username; 
    public $bio; 
    public $website;
    public $email_notification; 

    public function mount()
    {        
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->bio = $this->user->bio;
        $this->website = $this->user->website;
        $this->email_notification = $this->user->email_notification ? 'true' : 'false';
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', new Username, 'max:15', 'min:6', 'unique:users,username,' . $this->user->id],
            'bio' => ['nullable', 'string', 'min:20', 'max:250'],
            'website' => ['nullable', 'url', 'max:250'],
            'email_notification' => ['required', 'in:true,false'],
        ];
    }

    public function submit()
    {
        $data = $this->validate();
        $data['email_notification'] = $data['email_notification'] === 'true';
        
        $this->user->update($data);
    }

    public function render()
    {
        return view('livewire.dashboard.edit-profile');
    }
}
