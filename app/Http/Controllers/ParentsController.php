<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParentsRequest;
use App\Models\Parents;
use App\Models\Student;
use App\Traits\HasTryCatch;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ParentsController extends Controller
{
    use HasTryCatch;

    public function index(Request $request)
    {
        $request->limit ??= 10;

        return Inertia::render('Parents/DaftarParents', [
            'daftar' => Parents::select('id', 'nama_ayah', 'nama_ibu', 'kk')
                ->withCount('students as jumlah_siswa')
                ->orderBy('nama_ayah')

                // Filter
                ->when($request->nama, function ($query) use ($request) {
                    $query->where('nama_ayah', 'like', "%$request->nama%")
                        ->orWhere('nama_ibu', 'like', "%$request->nama%");
                })

                ->when($request->limit, fn ($query) => $query->limit($request->limit))
                ->get(),

            'cari' => [
                'nama' => $request->nama,
                'limit' => $request->limit
            ]
        ]);
    }

    public function profil(Parents $parents)
    {
        return Inertia::render('Parents/ProfilParents', [
            'parents' => $parents,
            'students' => Student::where('parents_id', $parents->id)
                ->select('id', 'nama', 'tanggal_lahir', 'foto')
                ->get()
                ->each
                ->append('usia')
        ]);
    }

    public function create()
    {
        return Inertia::render('Parents/TambahParents');
    }

    public function edit(Parents $parents)
    {
        return Inertia::render('Parents/EditParents', [
            'parents' => fn () => $parents,
        ]);
    }

    public function store(ParentsRequest $request)
    {
        $alert = $this::execute(
            try: fn () => Parents::create($request->input()),
            message: 'tambah parents'
        );

        return back()->with('alert', $alert);
    }

    public function update(ParentsRequest $request, Parents $parents)
    {
        $alert = $this::execute(
            try: fn () => $parents->update($request->input()),
            message: 'update parents'
        );

        return back()->with('alert', $alert);
    }

    public function destroy(Parents $parents)
    {
        $alert = $this::execute(
            try: fn () => $parents->forceDelete(),
            message: 'hapus parents'
        );

        return back()->with('alert', $alert);
    }
}
