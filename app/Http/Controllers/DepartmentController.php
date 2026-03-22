<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Department::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:departments',
            'location' => 'required|string',
            'status' => 'required|boolean'
        ]);

        $department = Department::create($data);

        return response()->json([
            'message' => 'Department created successfully',
            'data'=> $department
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $department = Department::with('employees')->findOrFail($id);
        
        return response()->json([
            'data' => $department
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $department = Department::findOr($id);

        $data = $request->validate([
            'name' => 'required|string|unique:departments,name,' . $id,
            'location' => 'nullable|string',
            'status' => 'boolean'
        ]);

        $department->update($data);
        return response() ->json([
            'message' => 'Department updated successfully',
            'data' => $department
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Department::destroy($id);
        return response()->json([
            'message' => 'Department deleted successfully'
        ], 200);
    }
}
