<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // 1. Method Show (Menampilkan Detail Data Siswa)
    public function show(Student $student)
    {
        return view('students.show', [
            'student' => $student
        ]);
    }

    // 2. Method Edit (Menampilkan Halaman Form Edit Siswa)
    public function edit(Student $student)
    {
        $majors = [
            'AKL', 'BiD', 'TKJ' // Daftar pilihan jurusan
        ];

        return view('students.edit', [
            'student' => $student,
            'majors'  => $majors
        ]);
    }

    // 3. Method Update (Memproses Pembaruan Data Siswa ke Database)
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

    // 4. Method Destroy (Menghapus Data Siswa dari Database)
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Berhasil Menghapus Data Siswa');
    }

    public function store(StoreRequest $request)
    {
        $validatedRequests = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'nis'   => ['required', 'string', 'size:4', 'unique:students'],
            'class' => ['required', 'string', 'max:50'],
            'major' => ['required', 'string', 'in:AKL,BiD,TKJ'],
        ]);

        Student::create($validatedRequests);

        return redirect()->route('students.index')
            ->with('success', 'Berhasil Menambahkan Data Siswa Baru');
    }
}