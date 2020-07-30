<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class BudgetController extends Controller
{

	public $occurances = [];

	public $originalBalanceDate;
	
	public $balanceDate;

	public $transactions;

	public $currentBalance;

	public $originalBalance;

	public $futureDate;

    public function show(Request $request)
    {

    	$this->originalBalance = 877064;

    	$this->currentBalance = 877064; //AccountBalance::all()->latest()->first();

    	$this->balanceDate = now()->addDay(2);//$currenBalance->date;

    	$this->originalBalanceDate = now()->addDay(2);//$currenBalance->date;

    	$this->transactions = Transaction::all();

    	$this->futureDate = now()->addMonth(4);


    	//dd(Transaction::find(6)->date->equalTo($this->balanceDate));

    	while($this->balanceDate->lte($this->futureDate))
    	{
    		$day_of_month = $this->balanceDate->day;
    		$day_of_week = $this->balanceDate->format('l');
    		$is_even_week = $this->balanceDate->format('W')%2==1;

    		foreach($this->transactions as $transaction)
    		{
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
    	//return $this->occurances;
    	return view('components.tables.budget')->with([
    		'account_balance'=> $this->originalBalance,
    		'account_balance_date' => $this->originalBalanceDate,
    		'occurances' => $this->occurances
    	]);
    }


    protected function addOccurance($transaction)
    {
    	$this->occurances[$this->balanceDate->format('F') . ' ' . $this->balanceDate->format('Y')][$this->balanceDate->day][] = [
			'transaction_detail' => $transaction,
			'running_total' => $this->currentBalance = $this->currentBalance + $transaction->amount_in_cents    				
		];
    }
}
