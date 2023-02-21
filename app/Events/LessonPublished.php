<?php

namespace App\Events;

use App\Models\Lesson;
use Illuminate\Queue\SerializesModels;

class LessonPublished
{
    use SerializesModels;

    public Lesson $lesson;

    public function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }
}
