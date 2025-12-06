<?php
namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(request $request)
    {
        $title = 'Manage Roles'; // Set the title for the index page
        $search = $request->input('search');

        // Check if there is a search query and filter the roles accordingly
        $roles = Role::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString(); // Preserve query string in pagination links

        return view('roles.index', compact('roles','title'));
    }

    public function create()
    {
        $title = 'Create Role'; // Set the title for the create page
        // Get permissions for the create view
        $permissions = Permission::orderBy('name', 'asc')->get();
        return view('roles.create', compact('permissions','title')); // Change to 'roles.create' instead of 'roles.index'
    }

    public function store(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3',
            // Ensure permissions are selected
        ]);

        if ($validator->passes()) {
            // Create the new role
            $role = Role::create(['name' => $request->name]);

            if (!empty($request->permission)) {
                // Attach selected permissions to the role
                foreach ($request->permission as $permissionId) {
                    $permission = Permission::find($permissionId);
                    if ($permission) {
                        $role->givePermissionTo($permission);
                    }
                }
            }

            // Redirect with success message
            return redirect()->route('roles.index')->with('success', 'Role Added successfully');
        } else {
            // Redirect with errors and input data
            return redirect()->route('roles.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $title = 'Edit Role'; // Set the title for the create page
        // Find the role by ID
        $role = Role::findOrFail($id);
        $haspermission = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'haspermission' => $haspermission,
            'title' => $title,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Find the role by ID
        $role = Role::findOrFail($id);

        // Validate the input
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id . ',id',
            'permission' => 'required|array|min:1' // Ensure permissions are selected
        ]);

        if ($validator->passes()) {
            // Update the role name
            $role->name = $request->name;
            $role->save();

            // Sync permissions with the role
            if (!empty($request->permission)) {
                $permissionNames = Permission::whereIn('id', $request->permission)->pluck('name')->toArray();
                $role->syncPermissions($permissionNames);
            } else {
                // If no permissions are selected, remove all permissions
                $role->syncPermissions([]);
            }

            // Redirect with success message
            return redirect()->route('roles.index')->with('success', 'Role Updated successfully');
        } else {
            // Redirect with errors and input data
            return redirect()->route('roles.edit', $id)->withErrors($validator)->withInput();
        }
    }

    public function destroy(Request $request, $id)
    {
        // Find and delete the role
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}