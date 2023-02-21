<?php

namespace App\Http\Controllers;

use App\Events\MinitutorAccepted;
use App\Models\JoinMinitutor;
use App\Models\Minitutor;
use Illuminate\Http\Request;

class JoinMinitutorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'not.minitutor']);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        return view('join-minitutor', ['data' => $user->joinMinitutor]);
    }

    public function getValidatedData(Request $request)
    {
        return $request->validate([
            'last_education_level' => 'required|string|in:' . implode(',', Minitutor::EDUCATION_LEVELS),
            'last_education_campus' => 'required|string|max:250',
            'last_education_location' => 'required|string|max:250',
            'last_education_majors' => 'required|string|max:250',
            'reason' => 'required|string|max:250',
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if ($user->joinMinitutor) {
            return abort(403);
        }
        $data = $this->getValidatedData($request);
        if (env('AUTO_ACCEPT_MINITUTOR', false)) {
            $user->minitutor()->save(new Minitutor($data));
            event(new MinitutorAccepted($user));
        } else {
            $user->joinMinitutor()->save(new JoinMinitutor($data));
        }

        return redirect()
            ->route('home')
            ->withSuccess('Anda telah mengajukan permintaan untuk menjadi minitutor, dan itu akan segera ditinjau oleh tim kami.');
    }

    public function update(Request $request)
    {
        $join = $request->user()->joinMinitutor;
        if (!$join) {
            return abort(403);
        }
        $data = $this->getValidatedData($request);
        $join->update($data);

        return redirect()
            ->route('join-minitutor')
            ->withSuccess('Permintaan untuk menjadi minitutor berhasil diperbarui.');
    }
}
