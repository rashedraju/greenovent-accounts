<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller {
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view( 'auth.login' );
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( LoginRequest $request ) {
        $request->authenticate();

        $request->session()->regenerate();

        switch ( auth()->user()->designation() ) {
            case 'Executive Director':
                return redirect()->route( 'dashboard' );
            case 'COO':
                return redirect()->route( 'dashboard' );
            case 'General Manager':
                return redirect()->route( 'projects.index' );
            case 'Accounts Manager':
                return redirect()->route( 'projects.index' );
            case 'Bussiness Manager':
                return redirect()->route( 'projects.index' );
            case 'Accounts Executive':
                return redirect()->route( 'accounts.finances.index' );
            case 'HR':
                return redirect()->route( 'employees.index' );
            default:
                return redirect()->route( 'employees.show', auth()->user() );
        }
        return redirect()->route( 'dashboard' );
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( Request $request ) {
        Auth::guard( 'web' )->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect( '/' );
    }
}
