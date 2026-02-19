<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\PollOption;

class PollController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

      // Seperate url-params for open polls and closed polls so the tables can be sorted individually
      $openPollsSort = $request->query('open_sort', 'ends_at');
      $openPollsDirection = $request->query('open_direction', 'asc');
      
      $closedPollsSort = $request->query('closed_sort', 'ends_at');
      $closedPollsDirection = $request->query('closed_direction', 'asc');
      
      // orderBy method requires boolean value as direction argument 
      $openPollsDirectionBool = $openPollsDirection === 'desc';
      $closedPollsDirectionBool = $closedPollsDirection === 'desc';

      // Use seperate table data
      $openPolls = Poll::active()->get()->sortBy(
        fn($poll) => $openPollsSort === "votes" ? $poll->totalVotes() :
          $poll->$openPollsSort, SORT_REGULAR, $openPollsDirectionBool);

      $closedPolls = Poll::closed()->get()->sortBy(
        fn($poll) => $closedPollsSort === "votes" ? $poll->totalVotes() :
          $poll->$closedPollsSort, SORT_REGULAR, $closedPollsDirectionBool);

      // Redirect to "homepage" with the necessary data from open and closed polls
      return view('home', compact('openPolls', 'closedPolls', 'openPollsSort', 'closedPollsSort', 'openPollsDirection', 'closedPollsDirection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
      $validated = $request->validate([
        'label' => 'required|min:5|max:50',
        'options' => 'array|required|min:2',
        'options.*' => 'required|string',
        'ends_at' => 'date'
      ], [
        // Personalized error messages 
      ], [
        'label' => 'title',
        'ends_at' => 'end date',
        'options.*' => 'poll option'
      ]);

      // Store poll as an object
      $poll = Poll::create($validated);
      
      // Handle options individually
      $pollOptions = $validated['options'];

      foreach ($pollOptions as $option){
        
        PollOption::create([
          'text' => $option,
          'poll_id' => $poll->id
          ]);
      }

       return redirect()
      ->route('home')
      ->with('success', 'Poll successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
