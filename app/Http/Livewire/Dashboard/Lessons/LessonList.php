<?php

namespace App\Http\Livewire\Dashboard\Lessons;

use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;
use Livewire\Component;

class LessonList extends Component
{
    public Lesson $lesson;

    public function render()
    {
        return view('livewire.dashboard.lessons.lesson-list');
    }
}
