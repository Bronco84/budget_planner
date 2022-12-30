<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{

     /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Budget::class, 'budget');
    }

	public $occurances = [];

	public $originalBalanceDate;

	public $balanceDate;

	public $transactions;

	public $currentBalance;

	public $originalBalance;

	public $futureDate;

    public function index(Request $request)
    {
        return redirect()->route('home');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request, Budget $budget)
    {

        $accountBalance = $budget->account_balances()->latest()->first();

        if(!$accountBalance){
            $request->session()->flash('status', 'Create account balance before viewing budget!');

            return redirect()->route('budget.account-balance.create', [$budget]);
        }

    	$this->originalBalance = $accountBalance->balance_in_cents;

    	$this->currentBalance = $accountBalance->balance_in_cents;

    	$this->balanceDate = $accountBalance->as_of_date;

    	$this->originalBalanceDate = $accountBalance->as_of_date;

    	$this->transactions = $budget->transactions;

    	$this->futureDate = now()->addMonth($budget->months_for_projection)->endOfMonth();

    	while($this->balanceDate->lte($this->futureDate))
    	{
    		$day_of_month = $this->balanceDate->day;
    		$day_of_week = $this->balanceDate->format('l');
    		$is_even_week = $this->balanceDate->format('W')%2==1;

    		foreach($this->transactions as $transaction)
    		{

                if($transaction->start_date && $transaction->start_date->gt($this->balanceDate)){
                    continue;
                }

                if($transaction->end_date && $transaction->end_date->lt($this->balanceDate)){
                    continue;
                }

    			if($transaction->date && $transaction->date->isSameDay($this->balanceDate)){
    				$this->addOccurance($transaction);
    			}else if($transaction->frequency == 'Monthly' && $transaction->day_of_month == $day_of_month){
    				$this->addOccurance($transaction);
    			}else if($transaction->frequency == 'Monthly' && $this->balanceDate->daysInMonth < 31 && $transaction->day_of_month > 28 && $this->balanceDate->daysInMonth == $this->balanceDate->day){
    				$this->addOccurance($transaction);
    			}else if($transaction->frequency == 'Bi-Weekly' && $transaction->day_of_week == $day_of_week){
    				if(($is_even_week && $transaction->parity == 'Even') || (!$is_even_week && $transaction->parity == 'Odd' )){
    					$this->addOccurance($transaction);
    				}
    			}else if($transaction->frequency == 'Weekly' && $transaction->day_of_week == $day_of_week){
    				$this->addOccurance($transaction);
    			}
    		}

    		$this->balanceDate->addDay(1);

    	}

    	return view('components.tables.budget')->with([
    		'account_balance'=> $this->originalBalance,
    		'account_balance_date' => $this->originalBalanceDate,
    		'occurances' => $this->occurances,
            'budget' => $budget,
    	]);
    }


    protected function addOccurance($transaction)
    {
        $transaction->load('activities');

    	$this->occurances[$this->balanceDate->format('F') . ' ' . $this->balanceDate->format('Y')][$this->balanceDate->day][] = [
			'transaction_detail' => $transaction,
			'running_total' => $this->currentBalance = $this->currentBalance + $transaction->amount_in_cents
		];
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('components.form.add-budget');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $budget = new Budget;

        $budget->description = $request->description;
        $budget->months_for_projection = $request->months_for_projection;
        $budget->notes = $request->notes;
        $budget->created_by = $request->user()->id;

        $budget->save();

        $request->user()->linked_budgets()->attach($budget);

        return redirect()->route('budget.show', [$budget]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        return view('components.form.edit-budget')->with(compact('budget'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budget $budget)
    {
        $budget->update($request->all());

        return back()->with('status', 'Budget was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {
        $budget->transactions()->delete();
        $budget->account_balances()->delete();
        $budget->connected_budgets()->detach();
        $budget->delete();
    }



}
