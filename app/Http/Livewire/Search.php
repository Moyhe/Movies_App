<?php

namespace App\Http\Livewire;


use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Search extends Component
{

    public $search = '';

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) >= 2) {
            $searchResults = Http::withToken(config('services.movie_api.token'))
                ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
                ->json()['results'];
        }

        return view('livewire.search', [
            'searchResults' => collect($searchResults)->take(6)
        ]);
    }
}
