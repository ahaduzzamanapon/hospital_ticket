<?php

namespace App\Http\Controllers\Backend;

use App\Models\TimeSlot;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('id', 'desc')->get();
        // dd($departments);
        return view('backend.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('backend.departments.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'department_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:14|min:11',
            'fees' => 'required|numeric',
            'time_slot' => 'required|array', // Validate as an array
            'time_slot.*' => 'required|string', // Validate each time slot
            'total_ticket' => 'required|array', // Validate as an array
            'total_ticket.*' => 'required|string', // Validate each total ticket
            'room_number' => 'required|string|max:50',
        ]);

        // Check if department_name and phone already exist in the database
        $existingDepartment = Department::where('name', $request->input('department_name'))
            ->orWhere('phone', $request->input('phone'))
            ->first();

        if ($existingDepartment) {
            // Redirect back with an error message if either exists
            return redirect()->back()->withErrors([
                'department_name' => 'The department name already exists in the database.',
                'phone' => 'The phone number already exists in the database.',
            ])->withInput();
        }

        // Save the department data using Eloquent
        $department = new Department();
        $department->name = $request->input('department_name');
        $department->description = $request->input('description');
        $department->phone = $request->input('phone');
        $department->fees = $request->input('fees');
        $department->total_slot = count($request->input('time_slot'));
        $department->room_number = $request->input('room_number');
        $department->save(); // Automatically sets created_at and updated_at

        // Save time slots using Eloquent
        $timeSlots = $request->input('time_slot');
        $totalTickets = $request->input('total_ticket');
        foreach ($timeSlots as $key => $timeSlot) {
            $timeSlotModel = new TimeSlot();
            $timeSlotModel->department_id = $department->id;
            $timeSlotModel->time_slot = $timeSlot;
            $timeSlotModel->total_ticket = $totalTickets[$key];
            $timeSlotModel->save(); // Automatically sets created_at and updated_at
        }

        // Redirect with success message
        return redirect()->route('admin.departments.index')->with('success', 'Department created successfully!');
    }

    public function show($id)
    {
        $department = Department::with('timeSlots')->findOrFail($id);
        // dd($department);
        return view('backend.departments.show', compact('department'));
    }

    public function edit($id)
    {
        $department = Department::with('timeSlots')->findOrFail($id);
        // dd($department);
        return view('backend.departments.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:14|min:11',
            'fees' => 'required|numeric',
            'time_slot' => 'required|array',
            'time_slot.*' => 'required|string',
            'total_ticket' => 'required|array',
            'total_ticket.*' => 'required|string',
            'room_number' => 'required|string|max:50',
        ]);

        $department = Department::findOrFail($id);
        $department->name = $request->input('department_name');
        $department->description = $request->input('description');
        $department->phone = $request->input('phone');
        $department->fees = $request->input('fees');
        $department->total_slot = count($request->input('time_slot'));
        $department->room_number = $request->input('room_number');
        $department->save();

        $timeSlots = $request->input('time_slot');
        $totalTickets = $request->input('total_ticket');

        // Delete old time slots
        $department->timeSlots()->delete();

        // Save updated time slots
        foreach ($timeSlots as $key => $timeSlot) {
            $department->timeSlots()->create([
                'time_slot' => $timeSlot,
                'total_ticket' => $totalTickets[$key],
            ]);
        }

        return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully!');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        $department->timeSlots()->delete();

        return redirect()->route('admin.departments.index')->with('success', 'Department deleted successfully!');
    }

}
