<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use App\Track;

class SongController extends Controller
{
	public function searchForm() {
		// Before the Song search form is shown, talk to the database and grab all the genres

		$genre = new Genre();

		var_dump($genre->all());

		// Can pass any variables to the view. Second parameter is an assoc array that passes $genres and $info
		return view('search_form', [
			'genres' => $genre->all(),
			'info' => 'helllo!!!'
		]);
	}

	public function search() {

		// GET the user inputs. Don't need to use $_GET[] thanks to Laravel
		$track_name = request('track_name');
		$genre = request('genre');

		$track = new Track();

		// Previously, we had to write fulll SQL statement to search, but Laravel has their own query methods 
		// SELECT * FROM tracks 
		$results = $track->select('tracks.name AS track_name', 'composer', 'genres.name AS genre');

		// Check for optional parameters - did user enter in a genre or track name?
		if( isset($track_name) && !empty($track_name) ) {
			$results = $results->where('tracks.name', 'LIKE' , '%' . $track_name .'%');
		}
		if( isset($genre) && !empty($genre) ) {
			$results = $results->where('tracks.genre_id', '=' , $genre);
		}

		// JOIN genres table and tracks table to see genre name in results
		$results = $results->leftJoin('genres', 'tracks.genre_id', '=', 'genres.genre_id');


		return view('search_results', [
			'tracks' => $results->get()
		]);

	}
}

?>