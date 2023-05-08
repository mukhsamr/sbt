<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlpItRequest;
use App\Models\PlpIt;
use App\Traits\HasTryCatch;
use Inertia\Inertia;

class PlpItController extends Controller
{
    use HasTryCatch;

    public function index()
    {
        return Inertia::render('PLP/PlpIt', [
            'daftar' => PlpIt::withCount('santris')->orderBy('plp')->get()
        ]);
    }

    public function store(PlpItRequest $request)
    {
        $alert = $this::execute(
            try: fn () => PlpIt::create($request->input()),
            message: 'tambah plp'
        );

        return back()->with('alert', $alert);
    }

    public function update(PlpItRequest $request)
    {
        $alert = $this::execute(
            try: fn () => PlpIt::where('id', $request->id)->update(['plp' => $request->plp]),
            message: 'update plp'
        );

        return back()->with('alert', $alert);
    }

    public function destroy(PlpIt $plpIt)
    {
        $alert = $this::execute(
            try: fn () => $plpIt->delete(),
            message: 'hapus plp'
        );

        return back()->with('alert', $alert);
    }
}
