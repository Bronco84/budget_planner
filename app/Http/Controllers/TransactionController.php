<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Budget;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Budget $budget)
    {
        $transactions = $budget->transactions;
        return view('components.tables.transactions')->with(compact('budget', 'transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('components.form.add-transaction');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'start_date' => 'date',
        ]);

        $transaction = new Transaction;

        $transaction->description = $request->description;
        $transaction->created_by = $request->user()->name;
        $transaction->account = $request->account;
        $transaction->category = $request->category;
        $transaction->frequency = $request->frequency;
        $transaction->date = $request->date;
        $transaction->day_of_week = $request->day_of_week;
        $transaction->day_of_month = $request->day_of_month;
        $transaction->amount_in_cents = $request->amount;
        $transaction->parity = $request->parity;
        $transaction->notes = $request->notes;

        $transaction->save();

        return redirect('transaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return $transaction;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget, Transaction $transaction)
    {
        return view('components.form.edit-transaction')->with(compact('budget', 'transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'start_date' => 'date',
        ]);

        $transaction->description = $request->description;
        $transaction->created_by = $request->user()->name;
        $transaction->account = $request->account;
        $transaction->category = $request->category;
        $transaction->frequency = $request->frequency;
        $transaction->date = $request->date;
        $transaction->day_of_week = $request->day_of_week;
        $transaction->day_of_month = $request->day_of_month;
        $transaction->amount_in_cents = $request->amount;
        $transaction->parity = $request->parity;
        $transaction->notes = $request->notes;

        $transaction->save();

        return redirect('transaction');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
    }

    public function duplicate(Transaction $transaction)
    {
        $new_transaction = $transaction->replicate();

        $new_transaction->save();

        return redirect()->route('transaction.edit', [$new_transaction]);
    }
}
