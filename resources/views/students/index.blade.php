@extends('layouts.app')

@section('title', $title)

@section('content')


<div class="mb-8 flex items-end justify-between border-b border-[#E5E3DB] pb-5">
    <div>
        <p class="mb-1 text-[11px] uppercase tracking-[0.2em] text-[#A16207]">Tahun Ajaran 2025/2026</p>
        <h1 class="font-display text-3xl font-semibold text-[#16213A]">Daftar Siswa</h1>
    </div>
    <a href="{{ route('students.create') }}" class="bg-[#16213A] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#26324f]">
        Catat Siswa Baru
    </a>
</div>

<div class="border border-[#E5E3DB] bg-white">
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="border-b border-[#16213A] text-[11px] uppercase tracking-[0.15em] text-[#16213A]">
                <th class="w-14 px-5 py-3.5 font-semibold">No.</th>
                <th class="px-5 py-3.5 font-semibold">NIS</th>
                <th class="px-5 py-3.5 font-semibold">Nama Siswa</th>
                <th class="px-5 py-3.5 font-semibold">Kelas</th>
                <th class="px-5 py-3.5 font-semibold">Jurusan</th>
                <th class="px-5 py-3.5 text-right font-semibold">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $student->nis }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->class }}</td>
        <td>{{ $student->major }}</td>
        <td>
            <a href="{{ route('students.show', ['student' => $student->id]) }}">Lihat</a>
            <a href="{{ route('students.edit', ['student' => $student->id]) }}">Ubah</a>
            <form method="POST"
                  onsubmit="return confirm('Hapus data siswa ini dari buku induk?')"
                  action="{{ route('students.destroy', ['student' => $student->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
@endforeach
            
        </tbody>
    </table>
</div>
@endsection
