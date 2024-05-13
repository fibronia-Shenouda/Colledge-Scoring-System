<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Rules\UserExists;
use Illuminate\Http\Request;
use App\Rules\UniqueTeamMember;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Rules\UniqueTeamMemberPerUser;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class TeamController extends Controller
{
  // Check number of events / Get form
  public function create(Request $request, $category)
  {
    if ($request->counterValue < 5) {
      return back()->with('error', 'You have at least join 5 event');
    } else {
      if ($category == 'individual') {
        return view('Pages.individualSign', [
          'events' => $request->events,
        ]);
      } else {
        return view('Pages.teamSign', [
          'events' => $request->events,
        ]);
      }
    }
  }

  // Indevidual Store
  public function indevidualsSore(Request $request)
  {
    $formFields = $request->validate([
      'team_name' => ['required', 'min:3', 'regex: /[a-zA-Z]+/', Rule::unique('teams', 'team_name')],
      'member1' => ['required', 'email', new UserExists, new UniqueTeamMemberPerUser],
      'events' => ['required'],
    ], ['member1.required' => 'Please provide the member email.', 'team_name.regex' => 'Team name must be a letters.']);

    $user = User::where('email', $formFields['member1'])->exists();

    if (!$user) {
      return back()->withErrors(['member1' => 'The user must register on the website first'])->withInput();
    }

    if ($request->member1 != auth()->user()->email) {
      return back()->with('error', 'You can join just with your email.');
    }

    Team::create($formFields);

    return back()->with('success', 'Team Created Successfully');
  }


  // Team Store
  public function teamStore(Request $request)
  {
    $formFields = $request->validate([
      'team_name' => ['required', 'min:3', 'regex: /[a-zA-Z]+/', Rule::unique('teams', 'team_name')],
      'member1' => ['required', 'email', new UserExists, new UniqueTeamMemberPerUser],
      'member2' => ['required', 'email', new UserExists, new UniqueTeamMember('member1'), new UniqueTeamMemberPerUser],
      'member3' => ['required', 'email', new UserExists, new UniqueTeamMember(['member1', 'member2']), new UniqueTeamMemberPerUser],
      'member4' => ['required', 'email', new UserExists, new UniqueTeamMember(['member1', 'member2', 'member3']), new UniqueTeamMemberPerUser,],
      'member5' => ['required', 'email', new UserExists, new UniqueTeamMember(['member1', 'member2', 'member3', 'member4']), new UniqueTeamMemberPerUser,],
      'events' => ['required'],
    ], ['member1.required' => 'Please provide the member email.', 'member2.required' => 'Please provide the member email.', 'member3.required' => 'Please provide the member email.', 'member4.required' => 'Please provide the member email.', 'member5.required' => 'Please provide the member email.', 'team_name.regex' => 'Team name must be a letters.']);

    Team::create($formFields);

    return back()->with('success', 'Team Created Successfully');
  }

  // Get teams
  public function getTeams(Request $request)
  {
    // Get the url parameter
    $filter = $request->query('filter');

    // Set initial filtering
    $oreder = 'desc';

    // Check if high or low
    if ($filter === 'low') {
      $oreder = 'asc';
    }
    if ($filter !== 'high') {
      $filter = 'high';
    }

    // Get the search parameter
    $search = $request->input('search');

    // Filter the teams with the score summition
    $query = Team::withSum('scores', 'score')->orderBy('scores_sum_score', $oreder);

    // Search filtering
    if ($search) {
      $query->where(function ($query) use ($search) {
        $query->where('team_name', 'like', "%$search%")->orWhere('member1', 'like', "%$search%");
      });
    }

    $teams = $query->paginate(6);

    // Finally retur the teams
    return view('Dashboard.teams', [
      'teams' => $teams,
    ]);
  }

  // Get individual
  public function getIndividual(Request $request)
  {
    // Get the url parameter
    $filter = $request->query('filter');

    // Set initial filtering
    $oreder = 'desc';

    // Check if high or low
    if ($filter === 'low') {
      $oreder = 'asc';
    }
    if ($filter !== 'high') {
      $filter = 'high';
    }

    // Get the search parameter
    $search = $request->input('search');

    // Filter the teams with the score summition
    $query = Team::withSum('scores', 'score')->orderBy('scores_sum_score', $oreder);

    // Search filtering
    if ($search) {
      $query->where(function ($query) use ($search) {
        $query->where('team_name', 'like', "%$search%")->orWhere('member1', 'like', "%$search%");
      });
    }

    $individuals = $query->paginate(6);

    // Finally return the indeviduals
    return view('Dashboard.individuals', [
      'individuals' => $individuals,
    ]);
  }
}
