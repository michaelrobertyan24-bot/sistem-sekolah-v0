<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
   use App\Http\Requests\Student\StoreRequest;

public function index()
{
    $title = "Sistem Sekolah - Daftar Siswa";
    $students = Student::select('id', 'nis', 'name', 'class', 'major')->get();

    return view('students.index', [
        'title' => $title,
        'students' => $students,
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
};