<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Employees
        $totalEmployees = Employee::count();
        
        // Employees by Department
        $employeesByDepartment = Department::withCount('employees')
            ->orderBy('employees_count', 'desc')
            ->limit(5)
            ->get();
        
        // Recent Employees (last 5)
        $recentEmployees = Employee::with(['department', 'designation'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Employees joined this month
        $employeesThisMonth = Employee::whereMonth('date_of_joining', now()->month)
            ->whereYear('date_of_joining', now()->year)
            ->count();
        
        // Employees joined this year
        $employeesThisYear = Employee::whereYear('date_of_joining', now()->year)
            ->count();
        
        // Total Departments
        $totalDepartments = Department::count();
        
        // Total Designations
        $totalDesignations = Designation::count();
        
        // Employees by Designation (top 5)
        $employeesByDesignation = Designation::withCount('employees')
            ->orderBy('employees_count', 'desc')
            ->limit(5)
            ->get();
        
        // Monthly employee growth (last 6 months)
        $monthlyGrowth = Employee::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        return view('dashboard', compact(
            'totalEmployees',
            'employeesByDepartment',
            'recentEmployees',
            'employeesThisMonth',
            'employeesThisYear',
            'totalDepartments',
            'totalDesignations',
            'employeesByDesignation',
            'monthlyGrowth'
        ));
    }
}
