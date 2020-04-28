<?php

namespace App\Http\Controllers;

use App\Model\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource by user.
     *
     * @return \Illuminate\Http\Response
     */
    public function allAccountsOfUser()
    {
        $userId = Auth::id();
        $result = Account::query()->where('user_id', '=',$userId)->get();
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $account = new Account($input);
        $account->user_id = Auth::id();
        $account->save();
        return response()->json($account, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        Gate::authorize('update-account', $account);
        $account->update($request->only('name'));
        return response()->json([$account], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        Gate::authorize('delete-account', $account);
        $account->delete();
        return response('', 204);
    }
}
