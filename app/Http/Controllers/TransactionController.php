<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Model\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class TransactionController extends Controller
{

    public function transactionsByPeriod($start, $end) {
        $result = DB::table('accounts')
            ->join('transactions', 'transactions.account_id', '=', 'accounts.id')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->select('transactions.*', 'accounts.name as account_name', 'categories.name as category_name')
            ->where('accounts.user_id', '=', Auth::id())
            ->whereBetween('transactions.date_at', [
                $start, $end,
            ])
            ->orderBy('transactions.date_at')
            ->get();
        
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $input = $request->validated();
        Gate::authorize('store-transaction', $input['account_id']);
        $transaction = new Transaction($input);
        $transaction->save();
        return response()->json($transaction, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        Gate::authorize('show-transaction', $transaction);
        return response()->json($transaction);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        Gate::authorize('update-transaction', $transaction);
        $input = $request->validated();
        $transaction->update($input);
        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        Gate::authorize('delete-transaction', $transaction);
        $transaction->delete();
        return response('', 204);
    }
}
