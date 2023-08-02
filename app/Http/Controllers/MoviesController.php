<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $popularMovies = Http::withToken(config('services.movie_api.token'))->get('https://api.themoviedb.org/3/movie/popular')->json()['results'];

       $nowPlayingMovies = Http::withToken(config('services.movie_api.token'))->get('https://api.themoviedb.org/3/movie/now_playing')->json()['results'];

       $genres = Http::withToken(config('services.movie_api.token'))->get('https://api.themoviedb.org/3/genre/movie/list')->json()['genres'];

       $viewModels = new MoviesViewModel(
        $popularMovies,
        $nowPlayingMovies,
        $genres,
      );

        return view('movies.index', $viewModels);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Http::withToken(config('services.movie_api.token'))->get(' https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')->json();

        return view('movies.show', compact('movie'));
    }
}
