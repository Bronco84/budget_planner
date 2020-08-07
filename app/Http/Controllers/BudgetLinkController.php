<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Budget;
use App\User;
use Illuminate\Validation\Rule;

class BudgetLinkController extends Controller
{
    public function show_link_form(Request $request)
    {
    	return view('components.form.link-budget')->with(['user' => $request->user()]);
    }

    public function store_link(Request $request)
    {

    	$user = User::where('email', $request->email)->first();
    	$budget_id = $request->id;

    	if(!$user){
    		return view('components.form.link-budget')->with(['user' => $request->user()])->withErrors(['user' => "The requested email was not found in our registered users!"]);
    	}

    	if($user->email == $request->user()->email){
    		return view('components.form.link-budget')->with(['user' => $request->user()])->withErrors(['user' => "You cannot link to your own budget. It can only be linked to other users."]);
    	}

    	$request->validate([
    		'budget_id' => Rule::unique('budget_user')->where(function ($query) use ($user) {
	                return $query->where('user_id', $user->id);
	        }),
    	], 
    	[
    		'budget_id.unique' => "This budget has already been linked to {$request->email}."
    	]);

    	$budget = Budget::findOrFail($request->id);
    	//$user->linked_budgets()->attach($budget);

    	return redirect()->route('home');
    }
}
