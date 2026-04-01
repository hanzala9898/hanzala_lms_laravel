<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //CRUD functions will be written here...

    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'parent_contact' => 'required',
            'date' => 'required|date',

        ]);

        try {
            Student::create($validated);
            return redirect()->back()->with('success', 'Student created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function get_students()
    {
        $students = Student::orderBy('id', 'desc')->get();
        return view('view-students', compact('students'));
    }

    public function edit($id)
    {
        $students = Student::findOrFail($id);
        return view('edit-student', compact('students'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'parent_contact' => 'required',
            'date' => 'required|date',
        ]);

        try {
            $students = Student::findOrFail($id);
            $students->update($validated);

            // Success: Redirect to the list page (get_students)
            return redirect()->route('students.get_students')->with('success', 'Student Record Updated Successfully!');
        } catch (\Exception $e) {
            // Failure: Back to the form with error message
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $students = Student::findOrFail($id);
        $students->delete();

        return redirect()->route('students.get_students')->with('error', 'Record Deleted Successfully');
    }

    public function countstd()
    {
        $stdcount = Student::count();
        return view('dashboard', compact('stdcount'));
    }

    public function search(Request $request)
    {
        $term = $request->get('term');

        $students = \App\Models\Student::where('name', 'LIKE', "%{$term}%")
            ->orWhere('email', 'LIKE', "%{$term}%")
            ->select('id', 'name') // Sirf specific columns
            ->groupBy('id', 'name') // Grouping se duplicates nahi aate
            ->limit(5)
            ->get();

        return response()->json($students);
    }
}
