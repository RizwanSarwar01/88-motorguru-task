<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Manage Users'; // Set the title for the index page
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.index', ['users' => $users, 'title' => $title]);
    }


    /* 	public function show(User $user)
        {
            // Return a view or JSON with user details
            return view('users.show', compact('user'));
        }
     */
    public function create()
    {
        $title = 'Create User'; // Set the title for the create page
        $roles = Role::orderBy('name', 'asc')->get();
        return view('users.create', compact('roles', 'title'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',



        ]);

        if ($validator->fails()) {
            return redirect()->route('users.create')->withErrors($validator)->withInput();
        }
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->sendEmailVerificationNotification();

        // Sync roles only if they are provided
        if ($request->has('role')) {
            $user->roles()->sync($request->role);
        }

        return redirect()->route('users.index')->with('success', 'User Added successfully');


    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit User'; // Set the title for the create page
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'asc')->get();
        $hasRoles = $user->roles->pluck('id');

        return view('users.edit', compact('user', 'roles', 'hasRoles', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|array' // Ensure role selection is an array
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $id)->withErrors($validator)->withInput();
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        // Sync roles only if they are provided
        if ($request->has('role')) {
            $user->roles()->sync($request->role);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

}
