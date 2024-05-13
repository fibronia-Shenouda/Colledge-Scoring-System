<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Event;
use App\Rules\NoLeadingZero;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Score;

class ScoreController extends Controller
{
  // Store Score Form
  public function storeScoreForm($id = null)
  {
    // All teams
    $teams = Team::get();

    // Initial events
    $events = [];

    // Initial eventIds
    $eventIds = [];

    if ($id) {
      // Specific team
      $team = Team::findOrFail($id);
      // Team events
      $eventIds = explode(',', $team->events);
      // Fetch event names based on event IDs
      $events = Event::whereIn('id', $eventIds)->pluck('name')->toArray();
    }
    return view('Dashboard.addScore', [
      "teams" => $teams,
      "events" => $events,
      "eventIds" => $eventIds,
    ]);
  }

  // Add Score
  public function add(Request $request)
  {
    $formScoreField = $request->validate([
      'score' => ['required', 'regex:/[0-9]+/', new NoLeadingZero],
      'team_id' => 'required',
      'event_id' => 'required',
    ]);

    Score::create($formScoreField);
    return back()->with('success', 'Score added successfully.');
  }

  // Results
  public function results(Request $request)
  {
    // Get the filter order from Query URL Paramenter
    $filter = $request->query('filter');

    // The defult filtering
    $order = 'desc';

    // Ajust the filter based on filter parameter
    if ($filter === 'low') {
      $order = 'asc';
    } elseif ($filter !== 'high') {
      $filter = 'high';
    }

    // Get the search value
    $search = $request->input('search');

    // Get the filtered results "Query to fetch scores with search and sorting"
    $query = Score::with('team', 'event')
      ->orderBy('score', $order);

    // Apply the search filtering
    if ($search) {
      $query->where(function ($query) use ($search) {
        $query->whereHas('team', function ($query) use ($search) {
          $query->where('team_name', 'like', "%$search%");
        })->orWhereHas('event', function ($query) use ($search) {
          $query->where('name', 'like', "%$search%");
        });
      });
    }

    // Get the results
    $results = $query->paginate(6);

    // Finally return the value
    return view('Dashboard.results', [
      "results" => $results,
    ]);
  }
}
