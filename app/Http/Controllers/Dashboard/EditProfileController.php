<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\AvatarHelper;
use App\Http\Controllers\Controller;
use App\Models\Minitutor;
use App\Rules\Username;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EditProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('minitutor:active')->only('updateMinitutor');   
    }

    public function index()
    {
        return view('dashboard.edit-profile');
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        if ($request->input('username')) {
            $request->merge(['username' => strtolower($request->input('username'))]);
        }
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', new Username, 'max:15', 'min:6', 'unique:users,username,' . $user->id],
            'bio' => ['nullable', 'string', 'min:20', 'max:250'],
            'website' => ['nullable', 'url', 'max:250'],
            'email_notification' => ['required', 'in:true,false'],
        ]);
        $data['email_notification'] = $data['email_notification'] === 'true';

        $user->update($data);

        return redirect()->back()->withSuccess('Informasi akun berhasil diperbarui.');
    }


    public function updatePassword(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'new_password' => ['required', Password::defaults()],
            'old_password' => ['required', 'current_password'],
        ]);
        $user->update([
            'password' => Hash::make($data['new_password'])
        ]);
        return redirect()->back()->withSuccess('Password berhasil diperbarui.');
    }


    public function updateMinitutor(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'last_education_level' => 'required|string|in:' . implode(',', Minitutor::EDUCATION_LEVELS),
            'last_education_campus' => 'required|string|max:250',
            'last_education_location' => 'required|string|max:250',
            'last_education_majors' => 'required|string|max:250',
        ]);
        $user->minitutor->update($data);
        return redirect()->back()->withSuccess('Informasi MiniTutor berhasil diperbarui.');
    }

    public function updateAvatar(Request $request)
    {
        $user = $request->user();
        $data = $request->validate(['image' => 'required|image|max:4000']);
        $avatar = AvatarHelper::generate($data['image'], $user->avatar);
        $user->avatar = $avatar;
        $user->save();
        return redirect()->back()->withSuccess('Foto profil berhasil diperbarui.');
    }
}
