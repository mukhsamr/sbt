<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasPondokRequest;
use App\Models\KelasPondok;
use App\Traits\HasTryCatch;
use Inertia\Inertia;

class KelasPondokController extends Controller
{
    use HasTryCatch;

    public function index()
    {
        return Inertia::render('KelasPondok', [
            'daftar' => KelasPondok::withCount('santris')->orderBy('kelas')->get()
        ]);
    }

    public function store(KelasPondokRequest $request)
    {
        $alert = $this::execute(
            try: fn () => KelasPondok::create($request->input()),
            message: 'tambah kelas pondok'
        );

        return back()->with('alert', $alert);
    }

    public function update(KelasPondokRequest $request)
    {
        $alert = $this::execute(
            try: fn () => KelasPondok::where('id', $request->id)->update(['kelas' => $request->kelas]),
            message: 'update kelas pondok'
        );

        return back()->with('alert', $alert);
    }

    public function destroy(KelasPondok $kelasPondok)
    {
        $alert = $this::execute(
            try: fn () => $kelasPondok->delete(),
            message: 'hapus kelas pondok'
        );

        return back()->with('alert', $alert);
    }
}
