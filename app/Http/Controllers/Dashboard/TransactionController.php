<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TransactionRequest;

class TransactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TransactionRequest $request, User $user)
    {
        $transaction = Transaction::create(
            array_merge(
                [
                    'actor_id' => auth()->user()->id,
                ],
                $request->allWithCustomerId()
            )
        );

        if ($request->hasFile('receipt')) {
            $transaction->addMediaFromRequest('receipt')
                        ->toMediaCollection('receipt');
        }

        flash(trans('transactions.messages.created'));

        return redirect()->route('dashboard.users.show', $user);
    }
}
