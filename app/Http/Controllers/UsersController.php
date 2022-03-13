<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeAddRequest;
use App\Http\Requests\EmployeeEditRequest;
use App\Models\ProjectStatus;
use App\Models\User;
use App\Models\UserDesignation;

class UsersController extends Controller {
    private $designations = [];

    public function __construct() {
        // Get all designations
        $this->designations = UserDesignation::all();
    }

    // View all users
    public function index() {
        // Get all users from
        $users = User::paginate( 10 );
        return view( 'users.index', ['users' => $users] );
    }

    // Show Employe Profile
    public function show( User $user ) {
        return view( 'users.show', ['user' => $user] );
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create() {

        return view( 'users.create', ['designations' => $this->designations] );
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

        // store profile image
        if ( $request->has( 'profile_image' ) ) {
            $fname = time() . $request->profile_image->getClientOriginalName();
            $profileImagePath = $request->file( 'profile_image' )->storeAs( 'profile_images', $fname, 'uploads' );

            // replace profile image file to image path
            $attrs = array_merge( $attrs, [
                'profile_image' => $profileImagePath
            ] );
        }

        // Create User
        $user = User::create( $attrs );

        if ( $user ) {
            return redirect()->route( 'employees' )->with( 'success', 'Employee addedd sccessfully' );
        }

        return redirect()->route( 'employees.create' )->with( 'failed', 'Failed to add Employee' );
    }

    // Edit user view
    public function edit( User $user ) {
        return view( 'users.edit', ['user' => $user, 'designations' => $this->designations] );
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
