<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlpBahasaRequest;
use App\Models\PlpBahasa;
use App\Traits\HasTryCatch;
use Inertia\Inertia;

class PlpBahasaController extends Controller
{
    use HasTryCatch;

    public function index()
    {
        return Inertia::render('PLP/PlpBahasa', [
            'daftar' => PlpBahasa::withCount('santris')->orderBy('plp')->get()
        ]);
    }

    public function store(PlpBahasaRequest $request)
    {
        $alert = $this::execute(
            try: fn () => PlpBahasa::create($request->input()),
            message: 'tambah plp'
        );

        return back()->with('alert', $alert);
    }

    public function update(PlpBahasaRequest $request)
    {
        $alert = $this::execute(
            try: fn () => PlpBahasa::where('id', $request->id)->update(['plp' => $request->plp]),
            message: 'update plp'
        );

        return back()->with('alert', $alert);
    }

    public function destroy(PlpBahasa $plpBahasa)
    {
        $alert = $this::execute(
            try: fn () => $plpBahasa->delete(),
            message: 'hapus plp'
        );

        return back()->with('alert', $alert);
    }
}
