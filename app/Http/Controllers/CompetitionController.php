<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Rules\MoreThan50Words;
use App\Rules\UniqueEventName;
use Illuminate\Validation\Rule;
use App\Rules\Between10And40Words;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class CompetitionController extends Controller
{
  // All Copmetitions
  public function index()
  {
    return view('Pages.home', [
      'competitions' => Competition::latest()->filter(request(['search', 'category']))->paginate(3),
    ]);
  }


  // Single Competition
  public function show($id)
  {
    $competitionWithEvents = Competition::find($id);

    return view('Pages.details', [
      'competition' => $competitionWithEvents,
    ]);
  }


  // Delete competition
  public function delete(Competition $competition)
  {
    $competition->delete();
    return back()->with('success', 'Competition deleted successfully.');
  }

  // Store competition form
  public function storeCompetitionsForm()
  {
    return view('Dashboard.createCompetition');
  }

  // Store competition
  public function storeCompetition(Request $request)
  {
    if ($request->competition_id == null) {
      return redirect('/add/competition')->with("error", "Please create the competition first.");
    } else {
      if (Competition::where('id', $request->competition_id)->exists()) {
        // Define validation rules for all event inputs
        $rules = [];
        for ($i = 1; $i <= 5; $i++) {
          $rules["name$i"] = ['required', 'string', 'regex: /[a-zA-Z]+/', 'min:3', new UniqueEventName("name" . $i - 1)];
          $rules["description$i"] = ['required', 'string', new Between10And40Words];
          $rules["is_academic$i"] = 'required|boolean';
        }

        // Validate all input data at once
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation succeeds, create events
        for ($i = 1; $i <= 5; $i++) {
          $event = new Event();
          $event->name = $request->input("name$i");
          $event->description = $request->input("description$i");
          $event->is_academic = $request->input("is_academic$i");
          $event->competition_id = $request->competition_id;
          $event->save();
        }

        // Redirect back with success message
        return redirect('/add/competition')->with('success', 'The Competitoin and it\'s events added successfully.');
      }
      return redirect('/add/competition')->with("error", "Please create the competition first.");
    }
  }

  // Store events form
  public function eventsForm(Request $request)
  {
    // dd($request);
    $formCompetitionFields = $request->validate([
      'name' => ['required', 'regex: /[a-zA-Z]+/', 'min:3', Rule::unique('competitions', 'name')],
      'description' => ['required', 'regex: /[a-zA-Z]+/', new MoreThan50Words],
    ], [
      'name.regex' => 'Name must be letters.',
    ]);

    if ($request->hasFile('photo')) {
      $formCompetitionFields['photo'] = $request->file('photo')->store('competitions', 'public');
    }

    $formCompetitionFields['is_team'] = $request->competition_category;

    $createCompetition = Competition::create($formCompetitionFields);
    // Set the competition ID in the session

    return redirect("/add/events/$createCompetition->id")->with("success", "Competition created successfully.\nCreate the events now.");
  }

  // Display events
  public function displayEvents($id)
  {
    return view('Dashboard.createEvents', ["competition_id" => $id]);
  }

  // Show edit form
  public function edit(Competition $competition)
  {
    // Get the related events
    $competition->load("events");

    // Return both
    return view('Dashboard.editCompetition', [
      "competition" => $competition
    ]);
  }

  // Update the competition
  public function update($id, Request $request)
  {
    // dd($request);
    $formCompetitionFields = $request->validate([
      'name' => ['required', 'regex: /[a-zA-Z]+/', 'min:3'],
      'description' => ['required', 'regex: /[a-zA-Z]+/', new MoreThan50Words],
      'is_team' => 'required',
    ], [
      'name.regex' => 'Name must be letters.',
    ]);

    if ($request->hasFile('photo')) {
      $formCompetitionFields['photo'] = $request->file('photo')->store('competitions', 'public');
    }

    $competition = Competition::find($id);

    $competition->update($formCompetitionFields);

    // Retrieve events belonging to the specific competition
    $competitionId = $id; // Assuming $id contains the competition ID
    $events = Event::where('competition_id', $competitionId)->get();


    // Update events
    foreach ($events as $event) {
      // Retrieve the input data for the current event
      $name = $request->input("name$event->id");
      $description = $request->input("description$event->id");
      $isAcademic = $request->input("is_academic$event->id");

      // Update event attributes
      $event->name = $name;
      $event->description = $description;
      $event->is_academic = $isAcademic;

      // Save the updated event
      $event->save();
    }


    return back()->with('success', 'Competition and events updated successfully');
  }
}
