<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StoreRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $title = "Sistem Sekolah - Daftar Siswa";

        $search = $request->query('search');
        $class  = $request->query('class');
        $major  = $request->query('major');

        $students = Student::select('id', 'nis', 'name', 'class', 'major')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                          ->orWhere('nis', 'like', "%{$search}%");
                });
            })
            ->when($class, fn ($query, $class) => $query->where('class', $class))
            ->when($major, fn ($query, $major) => $query->where('major', $major))
            ->paginate(10)
            ->withQueryString();

        $classOptions = ['X TKJ 1', 'XI TKJ 1', 'XII TKJ 1', 'XII AKL 2', 'XI BiD 2'];
        $majorOptions = ['AKL', 'BiD', 'TKJ'];

        return view('students.index', [
            'title' => $title,
            'students' => $students,
            'classOptions' => $classOptions,
            'majorOptions' => $majorOptions,
        ]);
    }

    public function create()
    {
        $title = "Sistem Sekolah - Tambah Siswa";

        return view('students.create', ['title' => $title]);
    }

    public function store(StoreRequest $request)
    {
        Student::create($request->validated());

        return redirect()->route('students.index')
            ->with('success', 'Berhasil Menambahkan Data Siswa Baru');
    }

    public function show(Student $student)
    {
        return view('students.show', ['student' => $student]);
    }

    public function edit(Student $student)
    {
        $majors = ['AKL', 'BiD', 'TKJ'];

        return view('students.edit', [
            'student' => $student,
            'majors' => $majors,
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $validatedRequests = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'nis'   => ['required', 'string', 'size:4', 'unique:students,nis,' . $student->id],
            'class' => ['required', 'string', 'max:50'],
            'major' => ['required', 'string', 'in:AKL,BiD,TKJ'],
        ]);

        $student->update($validatedRequests);

        return redirect()->route('students.index')
            ->with('success', 'Berhasil Memperbarui Data Siswa');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Berhasil Menghapus Data Siswa');
    }
}
