<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Parents;
use App\Models\Student;
use App\Traits\HasTryCatch;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    use HasTryCatch;

    public function index(Request $request)
    {
        $request->limit ??= 10;

        return Inertia::render('Siswa/DaftarSiswa', [
            'daftar' => Student::select('id', 'nama', 'nik', 'tanggal_lahir', 'foto', 'deleted_at')
                ->orderBy('nama')

                // Filter
                ->when($request->nama, fn ($query) => $query->where('nama', 'like', "%$request->nama%"))
                ->when($request->gender, fn ($query) => $query->where('gender', $request->gender))
                ->when($request->limit, fn ($query) => $query->limit($request->limit))

                ->withTrashed()
                ->get()
                ->each
                ->append('usia'),
            'cari' => [
                'nama' => $request->nama,
                'gender' => $request->gender,
                'limit' => $request->limit
            ]
        ]);
    }

    public function profil(Student $siswa)
    {
        return Inertia::render('Siswa/ProfilSiswa', [
            'siswa' => $siswa->append(['lahir', 'usia'])->load('parents')
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('Siswa/TambahSiswa', [
            'ayah' => fn () => Parents::select('id', 'nama_ayah')
                ->orderBy('nama_ayah')
                ->get(),
            'ibu' => fn () => Parents::select('id', 'nama_ibu')
                ->orderBy('nama_ibu')
                ->get(),
            'parents' => fn () => Parents::find($request->parents_id)
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

    public function store(StudentRequest $request)
    {
        $store = $request->input();

        if ($file = $request->file('foto')) {
            $nama = Str::slug($request->nama) . '.' . $file->getExtension();

            $file->storePubliclyAs("siswa/$nama");
            $store['foto'] = $nama;
        }

        $alert = $this::execute(
            try: fn () => Student::create($store),
            message: 'tambah siswa'
        );

        return back()->with('alert', $alert);
    }

    public function update(StudentRequest $request, Student $siswa)
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

    public function remove(Student $siswa)
    {
        $alert = $this::execute(
            try: fn () => $siswa->delete(),
            message: 'nonaktifkan siswa'
        );

        return back()->with('alert', $alert);
    }

    public function destroy(Student $siswa)
    {
        $alert = $this::execute(
            try: fn () => $siswa->forceDelete(),
            message: 'hapus siswa'
        );

        return back()->with('alert', $alert);
    }
}
