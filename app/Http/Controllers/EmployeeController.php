<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Manage Employees';
        $search = $request->input('search');

        $employees = Employee::with(['department', 'designation', 'nationality'])
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('mobile_number', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('employees.index', compact('employees', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Employee';
        $departments = Department::orderBy('name', 'asc')->get();
        $designations = Designation::orderBy('name', 'asc')->get();
        $nationalities = Nationality::orderBy('name', 'asc')->get();
        
        return view('employees.create', compact('departments', 'designations', 'nationalities', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'mobile_country_code' => 'required|string|max:5',
            'mobile_number' => 'required|string|max:20',
            'alternate_mobile_country_code' => 'nullable|string|max:5',
            'alternate_mobile_number' => 'nullable|string|max:20',
            'nationality_id' => 'nullable|exists:nationalities,id',
            'department_id' => 'nullable|exists:departments,id',
            'designation_id' => 'nullable|exists:designations,id',
            'date_of_birth' => 'nullable|date',
            'date_of_joining' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('employees.create')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('employees', $imageName, 'public');
            $data['image'] = $imagePath;
        } elseif ($request->has('image_base64')) {
            // Handle base64 image from camera
            $imageData = $request->input('image_base64');
            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $matches)) {
                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                $imageData = base64_decode($imageData);
                $extension = $matches[1];
                $imageName = time() . '_' . uniqid() . '.' . $extension;
                Storage::disk('public')->put('employees/' . $imageName, $imageData);
                $data['image'] = 'employees/' . $imageName;
            }
        }

        Employee::create($data);

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee->load(['department', 'designation', 'nationality']);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $title = 'Edit Employee';
        $departments = Department::orderBy('name', 'asc')->get();
        $designations = Designation::orderBy('name', 'asc')->get();
        $nationalities = Nationality::orderBy('name', 'asc')->get();
        
        return view('employees.edit', compact('employee', 'departments', 'designations', 'nationalities', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'mobile_country_code' => 'required|string|max:5',
            'mobile_number' => 'required|string|max:20',
            'alternate_mobile_country_code' => 'nullable|string|max:5',
            'alternate_mobile_number' => 'nullable|string|max:20',
            'nationality_id' => 'nullable|exists:nationalities,id',
            'department_id' => 'nullable|exists:departments,id',
            'designation_id' => 'nullable|exists:designations,id',
            'date_of_birth' => 'nullable|date',
            'date_of_joining' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('employees.edit', $employee->id)
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($employee->image) {
                Storage::disk('public')->delete($employee->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('employees', $imageName, 'public');
            $data['image'] = $imagePath;
        } elseif ($request->has('image_base64')) {
            // Handle base64 image from camera
            $imageData = $request->input('image_base64');
            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $matches)) {
                // Delete old image if exists
                if ($employee->image) {
                    Storage::disk('public')->delete($employee->image);
                }
                
                $imageData = substr($imageData, strpos($imageData, ',') + 1);
                $imageData = base64_decode($imageData);
                $extension = $matches[1];
                $imageName = time() . '_' . uniqid() . '.' . $extension;
                Storage::disk('public')->put('employees/' . $imageName, $imageData);
                $data['image'] = 'employees/' . $imageName;
            }
        } else {
            // Keep existing image if no new image is uploaded
            unset($data['image']);
        }

        $employee->update($data);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // Delete image if exists
        if ($employee->image) {
            Storage::disk('public')->delete($employee->image);
        }
        
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
