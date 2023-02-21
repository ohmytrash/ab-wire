<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\HeroHelper;
use App\Helpers\VideoHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->input('tab') ?? 'all';
        abort_unless(in_array($tab, ['all', 'public', 'private']), 404);

        $minitutor = $request->user()->minitutor;
        $query = Lesson::listQuery($minitutor->lessons(), false)->orderBy('updated_at', 'desc');

        switch ($tab) {
            case 'public':
                $query->where('public', true);
                break;
            case 'private':
                $query->where('public', false);
                break;
        }

        $lessons = $query->paginate(10);

        if ($request->input('tab')) {
            $lessons->appends('tab', $tab);
        }

        return view('dashboard.lessons.index', ['lessons' => $lessons, 'tab' => $tab]);
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        return view('dashboard.lessons.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $minitutor = $request->user()->minitutor;
        $data = $request->validate([
            'title' => 'required|string|max:250',
            'category' => 'required|exists:categories,id',
            'description' => 'required|string|max:2500',
        ]);
        $data['category_id'] = $data['category'];
        $lesson = new Lesson($data);
        $minitutor->lessons()->save($lesson);
        return redirect()->route('dashboard.lessons.edit', $lesson->id)->withSuccess('Berhasil membuat pelajaran baru.');
    }

    public function edit(Request $request, $id)
    {
        $tab = $request->input('tab');
        abort_unless(in_array($tab ?? 'info', ['info', 'hero', 'episodes']), 404);
        $minitutor = $request->user()->minitutor;
        $lesson = $minitutor->lessons()->findOrFail($id);
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        return view('dashboard.lessons.edit', ['categories' => $categories, 'lesson' => $lesson, 'tab' => $tab ?? 'info']);
    }

    public function destroy(Request $request, $id)
    {
        $minitutor = $request->user()->minitutor;
        $lesson = $minitutor->lessons()->with('episodes')->findOrFail($id);
        foreach ($lesson->episodes as $episode) {
            VideoHelper::destroy($episode->name);
        }
        HeroHelper::destroy($lesson->hero);
        $lesson->delete();
        return redirect()->route('dashboard.lessons.index')->withSuccess('Berhasil menghapus pelajaran.');
    }
}
