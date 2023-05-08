<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\Student;
use App\Traits\HasTryCatch;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    use HasTryCatch;

    public function index()
    {
        return Inertia::render('Siswa/DaftarSiswa', [
            'daftar' => Student::select('id', 'nama', 'nik', 'tanggal_lahir')
                ->orderBy('nama')
                ->get()
                ->each
                ->append('usia')
        ]);
    }

    public function profil(Student $siswa)
    {
        return Inertia::render('Siswa/ProfilSiswa', [
            'siswa' => $siswa->load('parents')
        ]);
    }

    public function edit(Request $request, Student $siswa)
    {
        return Inertia::render('Siswa/EditSiswa', [
            'siswa' => fn () => $siswa,
            'ayah' => fn () => Parents::select('id', 'nama_ayah')
                ->orderBy('nama_ayah')
                ->get(),
            'ibu' => fn () => Parents::select('id', 'nama_ibu')
                ->orderBy('nama_ibu')
                ->get(),
            'parents' => fn () => Parents::find($request->parents_id ?? $siswa->parents_id)
        ]);
    }

    public function update(Request $request, Student $siswa)
    {
        $update = $request->input();

        if ($foto = $request->file('foto')) {
            $name = Str::slug($siswa->nama) . '.' . $foto->extension();

            $foto->storePubliclyAs('siswa', $name);
            $update['foto'] = $name;
        }

        $alert = $this::execute(
            try: fn () => $siswa->update($update),
            message: 'update siswa'
        );

        return back()->with('alert', $alert);
    }

    public function destroy(Student $siswa)
    {
        $alert = $this::execute(
            try: fn () => $siswa->delete(),
            message: 'hapus siswa'
        );

        return back()->with('alert', $alert);
    }
}
