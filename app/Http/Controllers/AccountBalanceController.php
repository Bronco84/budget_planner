<?php

namespace App\Http\Controllers;

use App\AccountBalance;
use App\Budget;
use Illuminate\Http\Request;

class AccountBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Budget $budget)
    {
        return view('components.form.add-account-balance')->with(compact('budget'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Budget $budget, Request $request)
    {
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
     * Display the specified resource.
     *
     * @param  \App\AccountBalance  $accountBalance
     * @return \Illuminate\Http\Response
     */
    public function show(AccountBalance $accountBalance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AccountBalance  $accountBalance
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountBalance $accountBalance)
    {
        return view('components.form.add-account-balance');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AccountBalance  $accountBalance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountBalance $accountBalance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccountBalance  $accountBalance
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountBalance $accountBalance)
    {
        //
    }
}
