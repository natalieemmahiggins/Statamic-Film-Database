<?php

namespace App\Livewire;

use Livewire\Component;
use Jonassiewertsen\Livewire\WithPagination;
use Statamic\Entries\Entry;

class Films extends Component
{
    use WithPagination;

    public $perPage = 30;

    public $search;

    public $sort = 'Rating (Desc)';

    public $sortOptions = [
        'Rating (Asc)' => ['rating', 'asc'],
        'Rating (Desc)' => ['rating', 'desc'],
        'Date (Asc)' => ['release_date', 'asc'],
        'Date (Desc)' => ['release_date', 'desc'],
        'Popularity (Asc)' => ['popularity', 'asc'],
        'Populatiry (Desc)' => ['popularity', 'desc'],
    ];

    public $minRating = 7.8;

    public $ratingOptions = [
        7.8,
        7.9,
        8.0,
        8.1,
        8.2,
        8.3,
        8.4,
        8.5,
        8.6,
        8.7,
    ];

    protected function entries()
    {
        $entries = Entry::query()
            ->where('collection', 'films')
            ->where('published', true)
            ->where('rating', '>=', $this->minRating)
            ->where('title', 'like', '%'. $this->search .'%')
            ->orderBy($this->sortOptions[$this->sort][0], $this->sortOptions[$this->sort][1])
            ->paginate($this->perPage);
        
        return $this->withPagination('entries', $entries);
    }

    public function render()
    {
        return view('livewire.films', $this->entries());
    }
}
