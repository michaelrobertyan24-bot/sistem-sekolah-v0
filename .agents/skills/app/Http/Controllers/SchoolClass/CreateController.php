<?php

namespace App\Http\Controllers\SchoolClass;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
    $title = "Sistem Sekolah - Tambah Kelas";
    $majors = [
            [
                'id' => 1,
                'name' => 'TKJ',
            ],
            [
                'id' => 2,
                'name' => 'AKL',
            ],
            [
                'id' => 3,
                'name' => 'BID',
            ]                  
    ];
    $teachers = [
            [
                'id' => 1,
                'name' => 'Budi Santoso',
            ],
            [
                'id' => 2,
                'name' => 'Siti Aminah',
            ],
            [
                'id' => 3,
                'name' => 'Richard Marcell',
            ]                  
    ];
        return view('classes.create', [
            'title' => $title,
            'majors' => $majors,
            'teachers' => $teachers
        ]);
    }
}
