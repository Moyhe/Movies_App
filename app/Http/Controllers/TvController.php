<?php

namespace App\Http\Controllers;


use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvsShowViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

      $popularTv = Http::withToken(config('services.movie_api.token'))
        ->get('https://api.themoviedb.org/3/tv/popular')
        ->json()['results'];

       $topRatedTv = Http::withToken(config('services.movie_api.token'))
        ->get('https://api.themoviedb.org/3/tv/top_rated')
        ->json()['results'];

       $genres = Http::withToken(config('services.movie_api.token'))
        ->get('https://api.themoviedb.org/3/genre/tv/list')
        ->json()['genres'];


        $viewModel = new TvsShowViewModel(
            $popularTv,
            $topRatedTv,
            $genres,
        );

        return view('tvs.index', $viewModel);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tvShow = Http::withToken(config('services.movie_api.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,images')
        ->json();

        $viewModel = new TvShowViewModel($tvShow);

        return view('tvs.show', $viewModel);
    }
}
