<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeAddRequest;
use App\Http\Requests\EmployeeEditRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersController extends Controller {
    private $designations = [];

    public function __construct() {
        // Get all user roles as designations
        $this->designations = Role::all()->pluck( 'name' );
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

        // get designation and remove from attributes array
        $designation = $attrs['designation'];
        unset( $attrs['designation'] );

        // Create User
        $user = User::create( $attrs );

        // assign role
        $user->assignRole( $designation );

        if ( $user ) {
            return redirect()->route( 'employees.index' )->with( 'success', 'Employee addedd sccessfully' );
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

        // store profile image
        if ( $request->has( 'profile_image' ) ) {
            $fname = time() . $request->profile_image->getClientOriginalName();
            $profileImagePath = $request->file( 'profile_image' )->storeAs( 'profile_images', $fname, 'uploads' );

            // replace profile image file to image path
            $attrs = array_merge( $attrs, [
                'profile_image' => $profileImagePath
            ] );
        }

        // get designation and remove from attributes array
        $designation = $attrs['designation'];
        unset( $attrs['designation'] );

        // assign role
        $user->syncRoles( [$designation] );

        $user->update( $attrs );

        return redirect()->route( 'employees.edit', $user )->with( 'success', 'Employe profile has been updated!' );
    }

    // Delete User
    public function destroy( User $user ) {
        if ( $user->delete() ) {
            return redirect()->route( 'employees.index' )->with( 'success', 'Employee Removed Successfully' );
        }

        return redirect()->route( 'employees.index' )->with( 'failed', 'Failed to Remove Employee' );
    }
}
