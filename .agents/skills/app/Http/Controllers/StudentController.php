<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\UpdateRequest;
use App\Http\Requests\Student\StoreRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Sistem Sekolah - Daftar Siswa';

        $search = $request->query('search');
        $class = $request->query('class');
        $major = $request->query('major');

        $students = Student::select(['id', 'nis', 'name', 'major'])
        ->when($search, function($query, $search) {
            $query->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%");
            });
        })
        ->when($class, fn($query, $class) => $query->where('class', '=', $class))
        ->when($major, fn($query, $major) => $query->where('class', '=', $class))
        ->paginate(10)
        ->withQueryString();

        $schoolClasses = ['10 AKL', '11 AKL', '11 TKJ 1', '11 TKJ 2', '10 BID', '12 TKJ 1', '12 TKJ 2', '12 TKJ 3'];
        $majors = ['AKL', 'BID', 'TKJ'];

        return view('students.index', [
            'title' => $title,
            'students' => $students,
            'schoolClasses' => $schoolClasses,
            'majors' => $majors
        ]);
    }

    public function show(Student $student)
    {
        $title = 'Sistem Sekolah - Detail Siswa';

        return view('students.show', [
            'title' => $title,
            'student' => $student
        ]);
    }

    public function create()
    {
        $title = 'Sistem Sekolah - Tambah Siswa';

        return view('students.create', [
            'title' => $title,
        ]);
    }

    public function edit(Student $student)
    {
        $title = 'Sistem Sekolah - Edit Siswa';

        return view('students.edit', [
            'title' => $title,
            'student' => $student
        ]);
    }

    public function store(StoreRequest $request)
    {
        //validasi
        $validatedRequest = $request->validated();

        //Tambahkan Data ke Database
        Student::create($validatedRequest); 

        // Handle If Success
        return redirect()->route('students.index');
    }

    public function update(Student $student, UpdateRequest $request)
    {
            $validatedRequest = $request->validated();

        // Update Data
        $student->update($validatedRequest);

        // Handle if success
        return redirect()->route('students.index');
    }

    public function destroy(Student $student)
    {
        //Delete Data
        $student->delete();

        //Handle If Success
        return redirect()->route('students.index');
    }
}
