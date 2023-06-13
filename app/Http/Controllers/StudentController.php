<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.index', [
            'students' => Student::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create', [
            'title' => 'Create Student',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required|email',
            'jurusan' => 'required'
        ]);

        Student::create($student);

        return redirect('/students')->with('success', 'New Student has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return $student;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('dashboard.edit', [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required|email',
            'jurusan' => 'required'
        ]);

        Student::where('name', $student->name)->update($validatedData);

        return redirect('/students')->with('success', 'New Student has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        Student::destroy($student->id);

        return redirect('/students')->with('delete', 'New Student has been deleted!');
    }
}
