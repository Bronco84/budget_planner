<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\User;
use Illuminate\Validation\Rule;

class BudgetLinkController extends Controller
{
    public function create(Request $request, Budget $budget = null)
    {
    	return view('components.form.link-budget')->with(['user' => $request->user(), 'budget' => $budget]);
    }

    public function store(Request $request)
    {
        $budget = Budget::findOrFail($request->budget_id);

        $this->authorize('create', [BudgetLink::class, $budget]);

    	$user = User::where('email', $request->email)->first();

    	if(!$user){
    		return back()->with(['user' => $request->user()])->withErrors(['user' => "The requested email was not found in our registered users!"]);
    	}

    	if($user->email == $request->user()->email){
    		return view('components.form.link-budget')->with(['user' => $request->user()])->withErrors(['user' => "You cannot link to your own budget. It can only be linked to other users."]);
    	}

    	$request->validate([
    		'budget_id' => [
	    		Rule::unique('budget_user')->where(function ($query) use ($user) {
		                return $query->where('user_id', $user->id);
		        }),
		        'exists:budgets,id',
		        'required'
		    ]
    	],
    	[
    		'budget_id.unique' => "This budget has already been linked to {$request->email}."
    	]);

    	$budget = Budget::find($request->budget_id);

    	$user->linked_budgets()->attach($budget);

    	return back()->with('status', 'Budget linked successfully!');

    }

}
