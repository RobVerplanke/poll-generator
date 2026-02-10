<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Poll;

// Homepage - Where active and previous polls are displayed and can be sorted
Route::get('/', function(Request $request) {

  // Seperate url-params for open polls and closed polls so the tables can be sorted individually
  $openPollsSort = $request->query('open_sort', 'ends_at');
  $openPollsDirection = $request->query('open_direction', 'asc');
  
  $closedPollsSort = $request->query('closed_sort', 'ends_at');
  $closedPollsDirection = $request->query('closed_direction', 'asc');
  
  // orderBy method requires boolean value as direction argument 
  $openPollsDirectionBool = $openPollsDirection === 'desc';
  $closedPollsDirectionBool = $closedPollsDirection === 'desc';

  $openPolls = Poll::active()->get()->sortBy(
    fn($poll) => $openPollsSort === "votes" ? $poll->totalVotes() :
      $poll->$openPollsSort, SORT_REGULAR, $openPollsDirectionBool);

  $closedPolls = Poll::closed()->get()->sortBy(
    fn($poll) => $closedPollsSort === "votes" ? $poll->totalVotes() :
      $poll->$closedPollsSort, SORT_REGULAR, $closedPollsDirectionBool);

  return view('home', compact('openPolls', 'closedPolls', 'openPollsSort', 'closedPollsSort', 'openPollsDirection', 'closedPollsDirection'));
})->name('home');

// Create - View for creating new poll
Route::view('/create', 'create');

// Details - View with details of selected poll (active or closed)
Route::view('/details', 'details');