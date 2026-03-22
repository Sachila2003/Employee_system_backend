<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return response()->json([
        'data' => Employee::with('department')->latest()->get()
      ], 200);

      //serach logic
      if ($request->has('search')) {
         $query->where('first_name', 'like', '%' . $request->search . '%')
        ->orWhere('last_name', 'like', '%' . $request->search . '%');
      }

      return response()->json([
        'data' => $query->latest()->get()
      ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request-> validate([
            'first_name'=> 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:employees',
            'salary'=> 'required|numeric',
            'department_id' => 'required|exists:departments,id'
        ]);

        $employee = Employee::create($data);

        return response()->json([
            'message' => 'Employee created successfully',
            'data' => $employee->load('department')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $employee = Employee::with('department')->findOrFail($id);

        return response()->json([
            'data'=> $employee
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $data = $request-> validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:employees,email,' . $id,
            'salary' => 'required|numeric',
            'department_id' => 'required|exists:departments,id'
        ]);

        $employee->update($data);
        return response()->json([
            'message' => 'Employee updated successfully',
            'data' => $employee->load('department')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        Employee::destroy($id);
        return response()->json([
            'message' => 'Employee deleted successfully'
        ], 200);
    }
}
