<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\WithdrawRequest;
use App\Http\Requests\TransferRequest;
use App\Models\userTransaction ;
use App\Models\User ;

class UserController extends Controller
{
     /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('user.dashboard');
        
    }
    
    /**
     * Display a Deposite form.
     *
     * @return \Illuminate\Http\Response
     */
    public function deposit()
    {
        return view('user.deposit');
        
    }
    /**
     * insert Deposite data.
     *
     * @param  App\Models\userTransactions  $userTransactions
     * @param  App\Http\Requests\DepositRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function depositMoney(userTransaction $userTransaction , DepositRequest $request)
    {
    	$amount = $request->get('amount');

    	$userTransaction->user_id = auth()->user()->id;
    	$userTransaction->type = "credit";
    	$userTransaction->amount = $amount;
    	$userTransaction->balance = auth()->user()->amount + $amount;
    	$userTransaction->save();

    	return redirect()->route('deposit')
                ->withSuccess("Amount $amount INR deposit successfully");
    }

    /**
     * Display a withdraw form.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdraw()
    {
        return view('user.withdraw');
        
    }
    /**
     * Insert withdraw data.
     *
     * @param  App\Models\userTransactions  $userTransactions
     * @param  App\Http\Requests\WithdrawRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function withdrawMoney(userTransaction $userTransaction , WithdrawRequest $request)
    {
    	$amount = $request->get('amount');

    	$userTransaction->user_id = auth()->user()->id;
    	$userTransaction->type = "debit";
    	$userTransaction->amount = $amount;
    	$userTransaction->balance = auth()->user()->amount - $amount;
    	$userTransaction->save();

    	return redirect()->route('withdraw')
                ->withSuccess("Amount $amount INR withdraw successfully");
    }

 /**
     * Display a transfer form.
     *
     * @return \Illuminate\Http\Response
     */
    public function transfer()
    {
        return view('user.transfer');
        
    }
    /**
     * Insert transfer data.
     *
     * @param  App\Models\userTransactions  $userTransactions
     * @param  App\Http\Requests\TransferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function transferMoney(userTransaction $userTransaction , TransferRequest $request)
    {
    	$amount = $request->get('amount');
    	$otherUser = User::where('email',$request->get('email'))->first();

    	// add debit transaction for login user
    	$userTransaction->user_id = auth()->user()->id;
    	$userTransaction->transfer_user = $otherUser->id;
    	$userTransaction->type = "debit";
    	$userTransaction->amount = $amount;
    	$userTransaction->balance = auth()->user()->amount - $amount;
    	$userTransaction->save();

    	//add crdit transaction for beneficiary
    	$userTransaction = new userTransaction();
    	$userTransaction->user_id = $otherUser->id;
    	$userTransaction->transfer_user = auth()->user()->id;
    	$userTransaction->type = "credit";
    	$userTransaction->amount = $amount;
    	$userTransaction->balance = $otherUser->amount + $amount;
    	$userTransaction->save();

    	return redirect()->route('transfer')
                ->withSuccess("Amount $amount INR transfer successfully");
    }


    /**
     * Display a Account Statement.
     *
     * @return \Illuminate\Http\Response
     */
    public function statement()
    {
    	$transactions = auth()->user()->transaction()->paginate(env('PAGE_SIZE',20));

        return view('user.statement', compact('transactions'));
        
    }
}
