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
    public function create(Budget $budget)
    {
        return view('components.form.add-transaction')->with('budget', $budget);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Budget $budget)
    {

        $request->validate([
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'start_date' => 'date',
        ]);

        $transaction = new Transaction;
        $transaction->budget_id = $budget->id;
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

        activity()->performedOn($budget)->log("Added {$transaction->description} transaction for {$transaction->formatted_amount}.");

        return redirect()->route('budget.show', [$budget])->with('status', 'Transaction created successfully!');
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
    public function update(Request $request, Budget $budget, Transaction $transaction)
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

        activity()->performedOn($budget)->log("Edited {$transaction->description} transaction for {$transaction->formatted_amount}.");

        return redirect()->route('budget.show', [$budget])->with('status', $request->description . ' was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Budget $budget, Transaction $transaction)
    {
        activity()->performedOn($budget)->log("Deleted {$transaction->description} transaction for {$transaction->formatted_amount}.");

        $transaction->delete();
    }

    public function duplicate(Request $request, Budget $budget, Transaction $transaction)
    {
        $new_transaction = $transaction->replicate();

        $new_transaction->save();

        activity()->performedOn($budget)->log("Duplicated {$transaction->description} transaction for {$transaction->formatted_amount}.");

        return redirect()->route('budget.transaction.edit', [$budget, $new_transaction])->with('status', 'The transaction was duplicated successfully! Use the form to edit below.');;
    }

    public function activity(Request $request, Transaction $transaction)
    {
        $activities = $transaction->activities()->latest()->paginate();

        return view('components.tables.transaction_activities', ['paginated_data' => $activities, 'transaction' => $transaction]);
    }
}
