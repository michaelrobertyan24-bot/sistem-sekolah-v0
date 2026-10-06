<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
public function index()
{

 $title = "Sistem Sekolah - Daftar Siswa";

$students = Student::select('id', 'nis', 'name', 'class', 'major')->get();

return view( 'students. index', [

'title' => $title,

'students' => $students

]);
}
    public function show(string $id) 
    {
        $title = "Sistem Sekolah - Detail Siswa";
        return view('students.show', [
            'title' => $title
        ]);;;
    }
    
    public function create() 
    {
        $title = "Sistem Sekolah - Tambah Siswa";
        return view('students.create', [
            'title' => $title
        ]);
    }    

    public function edit(string $id) 
    {
        $title = "Sistem Sekolah - Edit Siswa";
        return view('students.edit', [
            'title' => $title
        ]);
    }   

    public function store() 
    {
        return "Melakukan penambahan data siswa";
    }  

    public function update(string $id) 
    {
        return "Melakukan perubahan data siswa dengan ID: {$id}";
    }  

    public function destroy(string $id) 
    {
        return "Menghapus data siswa dengan ID: {$id}";
    }  
}
