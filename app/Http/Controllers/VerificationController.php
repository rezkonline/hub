<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
    /**
     * Verify email form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function email()
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return abort(404);
        }
        
        return view('auth.verify');
    }

    /**
     * Resend user's email verification link.
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function resendEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

    /**
     * Mark user's email as verified.
     * 
     * @param EmailVerificationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function markEmailAsVerified(EmailVerificationRequest $request)
    {
        $request->fulfill();

        flash(trans('users.messages.email_verified'))->success();

        return redirect()->route('website.index');
    }
}
