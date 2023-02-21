<?php

namespace App\Http\Livewire\Dashboard\Lessons;

use App\Helpers\VideoHelper;
use App\Http\Livewire\LivewireAuthorizes;
use App\Models\Episode;
use Carbon\CarbonInterval;
use Livewire\Component;

class EpisodeList extends Component
{
    use LivewireAuthorizes;

    public Episode $episode;

    public $title;
    public $duration;

    public function mount()
    {
        $this->duration = CarbonInterval::seconds($this->episode->seconds)->cascade()->format('%H:%I:%S');
        $this->title = $this->episode->title;
    }

    public function updatedTitle()
    {
        $minitutor = $this->activeMinitutor();
        abort_unless($minitutor->id === $this->episode->lesson->minitutor_id, 403);

        $data = $this->validate(['title' => 'required|string|max:250']);
        $this->episode->update($data);
    }

    public function destroy()
    {
        $minitutor = $this->activeMinitutor();
        abort_unless($minitutor->id === $this->episode->lesson->minitutor_id, 403);

        VideoHelper::destroy($this->episode->name);
        $this->episode->delete();
        $this->emit('episode-deleted');
    }

    public function render()
    {
        return view('livewire.dashboard.lessons.episode-list');
    }
}
