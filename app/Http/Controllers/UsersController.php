<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeAddRequest;
use App\Http\Requests\EmployeeEditRequest;
use App\Models\User;
use App\Models\UserDesignation;
use App\Models\UserStatus;

class UsersController extends Controller {
    private $statuses = [];
    private $designations = [];

    public function __construct() {
        // Get all designations
        $this->designations = UserDesignation::all();

        // Get all user statuses
        $this->statuses = UserStatus::all();
    }

    // View all users
    public function index() {
        // Get all users from
        $users = User::paginate( 10 );
        return view( 'users.index', ['users' => $users] );
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create() {

        return view( 'users.create', ['designations' => $this->designations, 'statuses' => $this->statuses] );
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store( EmployeeAddRequest $request ) {
        // Validate Register Request and Validated Attributes
        $attrs = $request->validated();

        // Create User
        $user = User::create( $attrs );

        if ( $user ) {
            return redirect()->route( 'employees' )->with( 'success', 'Employee addedd sccessfully' );
        }

        return redirect()->route( 'employees.create' )->with( 'failed', 'Failed to add Employee' );
    }

    // Edit user view
    public function edit( User $user ) {
        return view( 'users.edit', ['user' => $user, 'designations' => $this->designations, 'statuses' => $this->statuses] );
    }

    /**
     * Handle an incoming update user request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update( EmployeeEditRequest $request, User $user ) {
        // Validate Register Request and Validated Attributes
        $attrs = $request->validated();

        $user->update( $attrs );

        return redirect()->route( 'employees.edit', $user )->with( 'success', 'Employe profile has been updated!' );
    }

    // Delete User
    public function destroy( User $user ) {
        if ( $user->delete() ) {
            return redirect()->route( 'employees' )->with( 'success', 'Employee Removed Successfully' );
        }

        return redirect()->route( 'employees' )->with( 'failed', 'Failed to Remove Employee' );
    }
}
