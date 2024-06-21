<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Models\Classes;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\ClassesResource;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index(Request $request)
    {
        
        $studentsQuery = Student::query();
        $this->applySearch($studentsQuery, $request->search);
        $students = StudentResource::collection(
           $studentsQuery->paginate(10)
        
    
    );
        
        return inertia('Students/Index', [
            'students' => $students,
        ]);
    }


    protected function applySearch($query, $search)
    {
        $query->where('email', 'like','%'.$search.'%');
    }

    public function create()
    {
        $classes = ClassesResource::collection(Classes::all());
        return inertia('Students/Create', [
            'classes' => $classes,
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        
        Student::create($request->validated());
        return redirect()->route('students.index')->with('Success', 'Student created successfully !');
    }

    public function edit(Student $student)
    {
        $classes = ClassesResource::collection(Classes::all());

        return inertia('Students/Edit', [
            'classes' => $classes,
            'student' => StudentResource::make($student),

        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }
}


