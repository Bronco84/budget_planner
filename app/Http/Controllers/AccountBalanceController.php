<?php

namespace App\Http\Controllers;

use App\Models\AccountBalance;
use App\Models\Budget;
use Illuminate\Http\Request;

class AccountBalanceController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Budget $budget)
    {
        $this->authorize('create', [ AccountBalance::class, $budget ]);

        $account_balance = $budget->account_balances()->latest()->first();
        return view('components.form.add-account-balance')->with(compact('budget', 'account_balance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Budget $budget, Request $request)
    {
        $this->authorize('create', [ AccountBalance::class, $budget ]);

        $account_balance = new AccountBalance;

        $account_balance->description = $request->description;
        $account_balance->user_id = $request->user()->id;
        $account_balance->notes = $request->notes;
        $account_balance->type = $request->type;
        $account_balance->as_of_date = $request->as_of_date;
        $account_balance->budget_id = $budget->id;
        $account_balance->balance_in_cents = $request->balance;

        $account_balance->save();

        return redirect()->route('budget.show', [$budget]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AccountBalance  $account_balance
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget, AccountBalance $account_balance)
    {
        return abort(404);//view('components.form.add-account-balance');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AccountBalance  $account_balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountBalance $account_balance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccountBalance  $account_balance
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountBalance $account_balance)
    {
        //
    }
}
