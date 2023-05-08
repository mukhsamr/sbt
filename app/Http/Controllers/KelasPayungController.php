<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasPayungRequest;
use App\Models\KelasPayung;
use App\Traits\HasTryCatch;
use Inertia\Inertia;

class KelasPayungController extends Controller
{
    use HasTryCatch;

    public function index()
    {
        return Inertia::render('KelasPayung', [
            'daftar' => KelasPayung::withCount('santris')->orderBy('kelas')->get()
        ]);
    }

    public function store(KelasPayungRequest $request)
    {
        $alert = $this::execute(
            try: fn () => KelasPayung::create($request->input()),
            message: 'tambah kelas payung'
        );

        return back()->with('alert', $alert);
    }

    public function update(KelasPayungRequest $request)
    {
        $alert = $this::execute(
            try: fn () => KelasPayung::where('id', $request->id)->update(['kelas' => $request->kelas]),
            message: 'update kelas payung'
        );

        return back()->with('alert', $alert);
    }

    public function destroy(KelasPayung $kelasPayung)
    {
        $alert = $this::execute(
            try: fn () => $kelasPayung->delete(),
            message: 'hapus kelas payung'
        );

        return back()->with('alert', $alert);
    }
}
