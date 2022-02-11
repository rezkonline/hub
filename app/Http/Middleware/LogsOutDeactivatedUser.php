<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use App\Models\Contracts\ActivatableContract;

class LogsOutDeactivatedUser
{
    /**
     * The Guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @throws \Exception
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $user = $this->auth->user();

        if ($user && $user instanceof ActivatableContract && $user->isNotActivated()) {
            if ($this->auth instanceof StatefulGuard) {
                $this->auth->logout();
            }

            return redirect()->back()->withInput()->withErrors([
                'login' => 'This account is blocked.',
            ]);
        }

        return $next($request);
    }
}
