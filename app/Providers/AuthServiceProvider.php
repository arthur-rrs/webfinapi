<?php

namespace App\Providers;

use App\Model\Account;
use App\Model\Transaction;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $authorizeTransaction =  function ($user, Transaction $t) {
            $account = $t->account()->get()->first();
            $user_id = $account->user_id;
            return $user_id === $user->id;
        };
        $this->registerPolicies();
        Gate::define('update-account', function($user, $account) {
            return $user->id === $account->user_id;
        });
        Gate::define('delete-account', function($user, $account) {
            return $user->id === $account->user_id;
        });
        Gate::define('store-transaction', function($user, $account_id) {
            $account = Account::all()->find($account_id);
            return $account->user_id === $user->id;
        });
        Gate::define('show-transaction', $authorizeTransaction);
        Gate::define('delete-transaction', $authorizeTransaction);
        Gate::define('update-transaction', $authorizeTransaction);
        Passport::routes();
    }
}
